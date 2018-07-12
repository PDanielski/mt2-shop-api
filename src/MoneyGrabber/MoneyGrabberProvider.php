<?php


namespace App\MoneyGrabber;


use App\Document\MoneyGrabber;

class MoneyGrabberProvider {
    /** @param MoneyGrabber[] */
    public function &getPoorest(&$moneygrabbers) {
        $totalEarnings = 0;
        foreach($moneygrabbers as $moneygrabber){
            $totalEarnings+= $moneygrabber->getEarnings();
        }

        $highestCredit = 0.0;
        $highestCreditOwner = $moneygrabbers[0];

        foreach($moneygrabbers as $moneygrabber){
            $moneyDeserved = $totalEarnings * $moneygrabber->getPercentage();
            $moneyReceived = $moneygrabber->getEarnings();
            $moneyReceived += $moneygrabber->getEarnOffset();
            $credit = $moneyDeserved - $moneyReceived;
            if($credit >= $highestCredit){
                $highestCredit = $credit;
                $highestCreditOwner = $moneygrabber;
            }
        }

        return $highestCreditOwner;
    }
}