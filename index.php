<?php

class PasswordComplexityCalculator {

    /**
     * Calculates the available passwords matching the criteria
     * @param int $lowerBound
     * @param int $upperBound
     * @return int
     */
    public function calculate(int $lowerBound, int $upperBound): int {
        $validPasswordFound = 0;
        for ($i = $lowerBound; $i <= $upperBound; $i++) {
            if ($this->isValidPassword($i)) {
                $validPasswordFound++;
            }
        }
        return $validPasswordFound;
    }

    /**
     * Verifies if the password is valid?
     * @param string $password
     * @return bool
     */
    private function isValidPassword(string $password): bool {
        $pwdCharactersArray = str_split($password);
        if (!$this->isValidLength($password)) {
            return false;
        }
        if ($this->doesValueIncrease($pwdCharactersArray)) {

            if ($this->doesHaveIncrementalDuplicates($pwdCharactersArray)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    /**
     * validates the real complex situation
     * @param array $password
     * @return bool
     */
    private function doesHaveIncrementalDuplicates(array $password): bool {
        $valCount = array_count_values($password);
        $modcount = 0;
        foreach ($valCount as $count) {
            if ($count % 2 == 0) {
                $modcount++;
            }
        }

        if (array_search(6, $valCount)) {
            return false;
        }

        if ($modcount == 1 && array_search(4, $valCount)) {
            return false;
        }

        if ($modcount >= 1) {
            return true;
        } else {
            return false;
        }
    }
    
    /**
     * validates if the digits in the password are incemental or not
     * @param string $password
     * @return bool
     */
    private function doesValueIncrease(string $password): bool {
        $val = 0;
        foreach ($password as $char) {
            if ($char >= $val) {
                $val = $char;
            } else {
                return false;
            }
        }
        return true;
    }
    /**
     * validates the length of password
     * @param string $string
     * @return bool
     */
    private function isValidLength(string $string): bool {
        if (strlen($string) == 6) {
            return true;
        } else {
            return false;
        }
    }

}
