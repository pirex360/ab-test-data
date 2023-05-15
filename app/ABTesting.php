<?php

namespace App;

use Exads\ABTestData;


class ABTesting
{
    private ABTestData $dataProvider;
    public array | null $selectedDesign;
    public string $promotionName;

    public function __construct(int $promotionId)
    {
        $this->dataProvider = new ABTestData($promotionId);

        $this->promotionName = $this->dataProvider->getPromotionName();
        $this->selectedDesign = null;
    }


    public function getTotalSplitPercent(array $designs):int
    {
        if ($designs)
        {
            $totalPercent = array_sum(array_column($designs, 'splitPercent'));

            if ($totalPercent !== 100)
            {
                throw new \Exception('The total splitPercent must be 100.');
            }

            return $totalPercent;
        }

        throw new \Exception('Empty Data From Provider !');
    }


    public function selectDesign():string
    {
        $designs = $this->dataProvider->getAllDesigns();

        $splitPercentTotal = $this->getTotalSplitPercent($designs);
        $randomNumber = random_int(1, $splitPercentTotal);

        $cumulativePercent = 0;
        foreach ($designs as $design)
        {
            $cumulativePercent += (int) $design['splitPercent'];
            if ($randomNumber <= $cumulativePercent)
            {
                $this->selectedDesign = $design;

                return $this->getDesignName($design);
            }
        }


        return "It's no possible to choose the design! Verify Provider Data.";
    }


    private function getDesignName(array $design):string
    {
       return $design['designName'];
    }

}

