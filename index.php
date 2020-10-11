class PasswordComplexityCalculator {

    public function calculate($lowerBound, $upperBound) {
        $validPasswordFound = 0;
        for ($i = $lowerBound; $i <= $upperBound; $i++) {
            if ($this->isValidPassword($i)) {
                $validPasswordFound++;
            }
        }
        return $validPasswordFound;
    }

    private function isValidPassword($password) {
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
    
    private function doesHaveIncrementalDuplicates2($password) {
        $valCount = array_count_values($password);
        $modcount = 0;
        foreach ($valCount as $key => $count) {
            if($count % 2 == 0){
                $modcount++;
            }
            
            
        }
        
        if(array_search(6, $valCount)) {
            return false;
        }
        
        if($modcount == 1 && array_search(4, $valCount)){
            return false;
        }
        
        if($modcount >= 1) {
            return true;
        } else {
            return false;
        }        
    }

    private function doesValueIncrease($password) {
        $val = 0;
        $prev = '';
        foreach ($password as $char) {
            if ($char >= $val) {
                $val = $char;
            } else {
                return false;
            }
        }
        return true;
    }

    private function isValidLength($string) {
        if (strlen($string) == 6) {
            return true;
        } else {
            return false;
        }
    }

}
