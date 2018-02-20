<?php
                    
                    #3 TOPICS.
                    $themeArray = ["love", "sport", "success", "programming"];
                    
                    #4 WRITTEN QUOTES.
                    $phraseArray = ["Life can only be understood backwards; but it must be lived forwards.",
                    "Beware the barrenness of a busy life.", 
                    "If you try, you risk failure. If you don’t, you ensure it.",
                    "If you do what you need, you’re surviving. If you do what you want, you’re living."];
                    
                    $randomTheme = array_rand($themeArray);
                    $randomPhrase = rand(0, count($phraseArray)-1);
                    
                    echo "<h3 style='color:white; padding:60px;'> $phraseArray[$randomPhrase] </h3>";
                
                    function start(){
                        global $randomTheme;
                        global $themeArray;
                        
                        switch ($randomTheme){
                            case 0: displayImageQuotes("love");
                                    break;
                            case 1: displayImageQuotes("success");
                                    break;
                            case 2: displayImageQuotes("sport");
                                    break;
                            case 3: displayImageQuotes("programming");
                                    break;
                        }
                    }
                    
                    function displayImageQuotes($myTheme){
                        $pictureArray = array();
                        array_push($pictureArray, 0,1,2,3);
                        
                        echo "<h3> #$myTheme </h3>";
                        
                        
                        
                        shuffle($pictureArray);
                        
                        for($i=0; $i<4; $i++){
                            echo "<img src='img/$myTheme/$pictureArray[$i].jpg' alt='$myTheme' title='$myTheme'/>";
                            
                            
                            // switch ($i){
                            //     case 1: echo "<img src='img/$myTheme/quote1.jpg' />";
                            //         break;
                            //     case 2: echo "<img src='img/$myTheme/quote2.jpg' />";
                            //         break;
                            //     case 3: echo "<img src='img/$myTheme/quote3.jpg' />";
                            //         break;
                            //     case 4: echo "<img src='img/$myTheme/quote4.jpg' />";
                            //         break;
                            }
                            
                        }
                        
?>
