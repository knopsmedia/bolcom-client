<?php declare(strict_types=1);

namespace Knops\BolcomClient\Service;

use Knops\BolcomClient\Model\ProductOfferInterface;
use Knops\BolcomClient\Validator\ProductOfferValidator;
use Knops\BolcomClient\Validator\ProductOfferValidatorInterface;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

final class BulkImportOffersBuilder
{
    private array $rows = [];
    private string $excelTemplateFile;
    private string $outputFilename;

    private ProductOfferValidatorInterface $validator;

    public function __construct(string $excelTemplateFile, ?string $outputFilename = null,
                                ?ProductOfferValidatorInterface $validator = null)
    {
        $this->excelTemplateFile = $excelTemplateFile;
        $this->outputFilename = $outputFilename ?? sprintf('build/%s.xlsx', date('YmdHis'));
        $this->validator = $validator ?? new ProductOfferValidator();
    }

    public function add(ProductOfferInterface $offer): self
    {
        if (!$this->validator->isValid($offer)) {
            throw new \InvalidArgumentException();
        }

        $this->rows[] = [
            $offer->getReference(),
            $offer->getEanCode(),
            $offer->getCondition(),
            $offer->getConditionComment(),
            $offer->getInventoryQuantity(),
            $offer->getPrice(),
            $offer->getDeliveryTime(),
            $offer->getFulfillmentBy(),
            $offer->isForSaleAfterUpload() ? 'ja' : 'nee',
            $offer->getName(),
            $offer->getDescription(),
        ];

        return $this;
    }

    public function addAll(array $offers): self
    {
        foreach ($offers as $offer) {
            $this->add($offer);
        }

        return $this;
    }

    public function build()
    {
        $spreadsheet = new Spreadsheet();
        $worksheet = $spreadsheet->setActiveSheetIndex(0);
        $worksheet->fromArray($this->rows, null, 'A2', true);

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save($this->outputFilename);
    }
}