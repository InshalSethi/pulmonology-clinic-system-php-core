 function calculateBmi() {
            var weight = document.bmiForm.weight.value
            var height = document.bmiForm.height.value
            /* 
            for feet calculation e.g. 5.10
            var fields = height.split(".");
            var ftHeight = fields[0];
            var inHeight = fields[1];
            var Newheight = 2.54 * (ftHeight * 12+ + +inHeight);
            */
            

            var oweight = weight;
            var oheight = height;
            
            if (weight > 0 && height > 0) {
                var finalBmi = (weight / (height / 100 * height / 100)) - 1
                var finalBmi = Math.ceil( finalBmi );
                document.bmiForm.bmi.value = finalBmi
                if (finalBmi < 18.5) {
                     var overweight=loweight(oheight, oweight);
                     var overweight = Math.ceil( overweight );

                    document.bmiForm.meaning.value = "Too thin! gain weight by " + " " + overweight +"Kg";
                }



                if (finalBmi > 18.5 && finalBmi <= 24) {
                    document.bmiForm.meaning.value = "You weight is ideal .";
                }
                if (finalBmi > 24) {
                     var newweight=hiweight(oheight, oweight);
                     var newweight = Math.ceil( newweight );

                    document.bmiForm.meaning.value = "Overweight By " + " " +newweight +"Kg";
                }
            } else {
                //alert("Please Fill in everything correctly")
            }

        }



        function hiweight(height, weight) {


            if ((height >= 134.6 && height < 137.1)) {
                correct_weight = 40.7;
                return weight - correct_weight;
            } else if ((height >= 137.1 && height < 139.7)) {
                correct_weight = 43.0;
                return weight - correct_weight;
            } else if ((height >= 139.7 && height < 142.2)) {
                correct_weight = 45.3;
                return weight - correct_weight;
            } else if ((height >= 142.2 && height < 144.7)) {
                correct_weight = 47.6;
                return weight - correct_weight;
            } else if ((height >= 144.7 && height < 147.3)) {
                correct_weight = 49.9;
                return weight - correct_weight;
            } else if ((height >= 147.3 && height < 149.8)) {
                correct_weight = 52.2;
                return weight - correct_weight;
            } else if ((height >= 149.8 && height < 152.4)) {
                correct_weight = 54.5;
                return weight - correct_weight;
            }
            /**/
            else if ((height >= 152.4 && height < 154.9)) {
                correct_weight = 56.8;
                return weight - correct_weight;
            } else if ((height >= 154.9 && height < 157.4)) {
                correct_weight = 59.1;
                return weight - correct_weight;
            } else if ((height >= 157.4 && height < 160.0)) {
                correct_weight = 61.4;
                return weight - correct_weight;
            } else if ((height >= 160.0 && height < 162.5)) {
                correct_weight = 63.6;
                return weight - correct_weight;
            } else if ((height >= 162.5 && height < 165.1)) {
                correct_weight = 65.9;
                return weight - correct_weight;
            } else if ((height >= 165.1 && height < 167.6)) {
                correct_weight = 65.9;
                return weight - correct_weight;
            } else if ((height >= 167.6 && height < 170.1)) {
                correct_weight = 68.2;
                return weight - correct_weight;
            } else if ((height >= 170.1 && height < 172.7)) {
                correct_weight = 70.5;
                return weight - correct_weight;
            } else if ((height >= 172.7 && height < 175.2)) {
                correct_weight = 72.7;
                return weight - correct_weight;
            } else if ((height >= 175.2 && height < 177.8)) {
                correct_weight = 75.0;
                return weight - correct_weight;
            } else if ((height >= 177.8 && height < 180.3)) {
                correct_weight = 77.3;
                return weight - correct_weight;
            } else if ((height >= 180.3 && height < 182.8)) {
                correct_weight = 79.5;
                return weight - correct_weight;
            } else if ((height >= 182.8 && height < 185.4)) {
                correct_weight = 81.8;
                return weight - correct_weight;
            } else if ((height >= 185.4 && height < 187.9)) {
                correct_weight = 84.1;
                return weight - correct_weight;
            } else if ((height >= 187.9 && height < 190.5)) {
                correct_weight = 86.4;
                return weight - correct_weight;
            } else if ((height >= 190.5 && height < 193.0)) {
                correct_weight = 88.6;
                return weight - correct_weight;
            } else if ((height >= 193.0 && height < 195.5)) {
                correct_weight = 90.9;
                return weight - correct_weight;
            } else if ((height >= 195.5 && height < 198.0)) {
                correct_weight = 93.2;
                return weight - correct_weight;
            } else if ((height >= 198.0 && height < 200.5)) {
                correct_weight = 95.5;
                return weight - correct_weight;
            } else if ((height >= 200.5 && height < 203.0)) {
                correct_weight = 97.8;
                return weight - correct_weight;
            }
        }

        function loweight(height, weight) {


            if ((height >= 134.6 && height < 137.1)) {
                correct_weight = 34.0;
                return correct_weight - weight;
            } else if ((height >= 137.1 && height < 139.7)) {
                correct_weight = 36.3;
                return correct_weight - weight;
            } else if ((height >= 139.7 && height < 142.2)) {
                correct_weight = 36.3;
                return correct_weight - weight;
            } else if ((height >= 142.2 && height < 144.7)) {
                correct_weight = 38.6;
                return correct_weight - weight;
            } else if ((height >= 144.7 && height < 147.3)) {
                correct_weight = 40.9;
                return correct_weight - weight;
            } else if ((height >= 147.3 && height < 149.8)) {
                correct_weight = 40.9;
                return correct_weight - weight;
            } else if ((height >= 149.8 && height < 152.4)) {
                correct_weight = 43.2;
                return correct_weight - weight;
            } else if ((height >= 152.4 && height < 154.9)) {
                correct_weight = 45.5;
                return correct_weight - weight;
            } else if ((height >= 154.9 && height < 157.4)) {
                correct_weight = 45.5;
                return correct_weight - weight;
            }
            /**/
            else if ((height >= 157.4 && height < 160.0)) {
                correct_weight = 47.7;
                return correct_weight - weight;
            } else if ((height >= 160.0 && height < 162.5)) {
                correct_weight = 47.7;
                return correct_weight - weight;
            } else if ((height >= 162.5 && height < 165.1)) {
                correct_weight = 50.0;
                return correct_weight - weight;
            } else if ((height >= 165.1 && height < 167.6)) {
                correct_weight = 52.3;
                return correct_weight - weight;
            } else if ((height >= 167.6 && height < 170.1)) {
                correct_weight = 52.3;
                return correct_weight - weight;
            } else if ((height >= 170.1 && height < 172.7)) {
                correct_weight = 54.5;
                return correct_weight - weight;
            } else if ((height >= 172.7 && height < 175.2)) {
                correct_weight = 56.8;
                return correct_weight - weight;
            } else if ((height >= 175.2 && height < 177.8)) {
                correct_weight = 56.8;
                return correct_weight - weight;
            } else if ((height >= 177.8 && height < 180.3)) {
                correct_weight = 59.1;
                return correct_weight - weight;
            } else if ((height >= 180.3 && height < 182.8)) {
                correct_weight = 61.4;
                return correct_weight - weight;
            } else if ((height >= 182.8 && height < 185.4)) {
                correct_weight = 63.6;
                return correct_weight - weight;
            } else if ((height >= 185.4 && height < 187.9)) {
                correct_weight = 63.6;
                return correct_weight - weight;
            } else if ((height >= 187.9 && height < 190.5)) {
                correct_weight = 65.9;
                return correct_weight - weight;
            } else if ((height >= 190.5 && height < 193.0)) {
                correct_weight = 68.2;
                return correct_weight - weight;
            } else if ((height >= 193.0 && height < 195.5)) {
                correct_weight = 70.5;
                return correct_weight - weight;
            } else if ((height >= 195.5 && height < 198.0)) {
                correct_weight = 72.8;
                return correct_weight - weight;
            } else if ((height >= 198.0 && height < 200.5)) {
                correct_weight = 75.1;
                return correct_weight - weight;
            }
            if ((height >= 200.5 && height < 203.0)) {
                correct_weight = 77.4;
                return correct_weight - weight;
            }
        }