<?php

namespace Tests\Unit;

use App\ABTesting;
use Exads\ABTestData;
use PHPUnit\Framework\TestCase;

class ABTest extends TestCase
{
    public array $promotionsId = [1,2,3];

    public function test_selected_design_returns_string()
    {
        foreach($this->promotionsId as $promotion)
        {
            $abTesting = new ABTesting($promotion);
            $this->assertIsString($abTesting->selectDesign());
        }
    }

    public function test_if_selected_design_returns_a_valid_design_name_from_promotion_data()
    {
        foreach($this->promotionsId as $promotion)
        {
            $designs = (new ABTestData($promotion))->getAllDesigns();
            $allDesignNames = array_column($designs, 'designName');
            $selectedDesign = (new ABTesting($promotion))->selectDesign();

            $this->assertContains($selectedDesign, $allDesignNames);
        }

    }

    public function test_total_split_percentage_adds_up_to_100()
    {
        foreach($this->promotionsId as $promotion)
        {
            $designs = (new ABTestData($promotion))->getAllDesigns();
            $totalPercent = array_sum(array_column($designs, 'splitPercent'));

            $this->assertSame(100, $totalPercent);
        }


    }


    public function test_error_if_total_split_percentage_different_100()
    {
        $designs = [
            ["splitPercent" => 20],
            ["splitPercent" => 50],
            ["splitPercent" => 35],
        ];

        $this->expectException(\Exception::class);

        (new ABTesting(1))->getTotalSplitPercent($designs);

        $this->expectExceptionMessage('The total splitPercent must be 100.');

    }


    public function test_selected_designs_probability_check()
    {
        $abTesting = new ABTesting(1);
        $designs = [];

        for ($i = 0; $i < 250; $i++) {
            $design = $abTesting->selectDesign();

            if (!isset($designs[$design])) {
                $designs[$design] = 1;
            } else {
                $designs[$design]++;
            }
        }

        $this->assertGreaterThan($designs['Test B'], $designs['Test A']);
        $this->assertGreaterThan($designs['Test C'], $designs['Test A']);
    }

}
