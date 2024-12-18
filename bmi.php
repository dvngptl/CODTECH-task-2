<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $Height=$_POST['height'];
        $HeightUnit=$_POST['heightUnit'];
        $Weight=$_POST['weight'];
        $WeightUnit=$_POST['weightUnit'];
        if($Height == '' || $Weight == '' || $HeightUnit == '' || $WeightUnit == ''){
                $Error = "The input values are required.";
        }
        elseif (filter_var($Height, FILTER_VALIDATE_FLOAT) === false || filter_var($Weight, FILTER_VALIDATE_FLOAT) === false) {
                $Error = "The input value must be a number only.";
        }
        else{
                /*Calculation begins from here.*/
                /*Convert cm to inch -> foot to inch -> meter to inch */
                $HInches = ($HeightUnit=='centimeter')?$Height*0.393701:(($HeightUnit=='foot')?$Height*12:(($HeightUnit=='meter')?$Height*39.3700787:$Height));
                /*Convert kg to pound*/
                $WPound = ($WeightUnit=='kilogram')?$Weight*2.2:$Weight;
                $BMIIndex = round($WPound/($HInches*$HInches)* 703,2);

                /*Set Message*/
                if ($BMIIndex < 18.5) {
                        $Message="Underweight";
                } else if ($BMIIndex <= 24.9) {
                        $Message="Normal";
                } else if ($BMIIndex <= 29.9) {
                        $Message="Overweight";
                } else {
                        $Message="Obese";
                }
        }
} ?>
