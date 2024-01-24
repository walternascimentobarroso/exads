<?php

namespace App\ABTesting;

use Exads\ABTestData;

/**
 * Class AB
 *
 * This class represents an A/B testing mechanism for selecting and redirecting
 * users based on different designs.
 */
class AB
{

    /**
     * @var ABTestData $abTestData An instance of the ABTestData class,
     * which provides A/B testing data.
     */
    private $abTestData;

    /**
     * AB constructor.
     *
     * @param int $promoId The promotion ID used to initialize
     * the A/B testing data.
     */
    public function __construct($promoId)
    {
        $this->abTestData = new ABTestData($promoId);
    }

    /**
     * Retorna a instância de ABTestData associada a esta instância de AB.
     *
     * @return ABTestData
     */
    public function getAbTestData()
    {
        return $this->abTestData;
    }

    /**
     * Redirects the user to a specific design based on A/B testing criteria.
     *
     * @return string The URL to which the user should be redirected.
     */
    public function redirect()
    {
        $designId = $this->chooseDesign();
        $redirectUrl = $this->getRedirectUrl($designId);
        return $redirectUrl;
    }

    /**
     * Chooses a design based on A/B testing split percentages.
     *
     * @return mixed The ID of the selected design.
     */
    private function chooseDesign()
    {
        $rand = mt_rand(1, 100);
        $cumulativePercent = 0;

        $designs = $this->getAbTestData()->getAllDesigns();

        foreach ($designs as $design) {
            $cumulativePercent += $design['splitPercent'];
            if ($rand <= $cumulativePercent) {
                return $design['designId'];
            }
        }

        // Fallback: Return the first design if the random number exceeds 100
        return $designs[0]['designId'];
    }

    /**
     * Generates the redirect URL based on the selected design.
     *
     * @param int $designId The ID for which the redirect URL is generated.
     * @return string The complete redirect URL.
     */
    private function getRedirectUrl($designId)
    {
        return "https://www.exads.com/design$designId";
    }
}
