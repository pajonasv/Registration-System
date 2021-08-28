<html>
<head></head>

<body>

    <?php
    include 'global.php';
    set_time_limit(0);

    function incSemester($value){
        switch ($value){
            case 92:
                $value = 95;
                break;
            case 93:
                $value = 92;
                break;
            case 94:
                $value = 97;
                break;
            case 95:
                $value = 94;
                break;
            case 96:
                $value = 99;
                break;
            case 97:
                $value = 96;
                break;
            case 98:
                $value = 0;
                break;
            case 99:
                $value = 98;
                break;
            case 0:
                $value = 1;
                break;
            default:
                $value = 2;
                break;

        }
        
        return $value;

    }
    function createMajorClassArray($majorID){
    if($majorID == 0){
        

       $toReturn = array(
        "MA2090",
        "CS2511",
        "MA2310",
        "MA2320",
        "MA3030",
        "MA3160",
        "MA3210",
        "MA3330",
        "MA3520",
        "MA4360",
        "MA5120",
        "MA5320"
       );

       $potential = array(
        "MA4100",
        "MA4200",
        "MA4510",
        "MA4910",
        "MA4920",
        "MA5230",
        "MA5380",
        "MA5510"
    );
       
       $offset = rand(0, count($potential)-3);

       array_push($toReturn, $potential[$offset]);
       array_push($toReturn, $potential[$offset+1]);
       array_push($toReturn, $potential[$offset+2]);
       
    }
    else if($majorID == 1){
        /*
            CS2510 Computer Programming I
            CS2511 Computer Programming II
            MA2090 - Precalculus
            MA2310 - Calc & Analytic Geometry I
            MA3030 Discrete Mathematics
            MA3210 Intro. To Probability & Statistics
            MA4100 Number Theory
            CS3620 Computer Architecture I
            CS3810 Data Structures and Algorithms
            CS3911 C++ and Object-Oriented Programming
            CS4100 Technical Communications
            CS4501 Software Engineering
            CS4550 Database Management Systems
            CS4720 Internet and Web Technologies
            CS5910 System Design & Implementation

            CS4200 Mobile Programming via Android
            CS4400 Artificial Intelligence
            CS4705 Computer Security
            CS4710 Applied Cryptography
            CS5610 Operating Systems
            CS5710 Computer Networks
            CS5730 Computer Network Security
            CS5810 Data Mining
    */

        $toReturn = array(
            "CS2511",
            "CS2510",
            "MA2090",
            "MA2310",
            "MA3030",
            "MA3210",
            "MA4100",
            "CS3620",
            "CS3810",
            "CS3911",
            "CS4100",
            "CS4501",
            "CS4550",
            "CS4720",
            "CS5910"
        );
 
        $potential = array(
            "CS4200",
            "CS4400",
            "CS4705",
            "CS4710",
            "CS5610",
            "CS5710",
            "CS5730",
            "CS5810"
     );
        
        $offset = rand(0, count($potential)-3);
 
        array_push($toReturn, $potential[$offset]);
        array_push($toReturn, $potential[$offset+1]);
        array_push($toReturn, $potential[$offset+2]);
        
     }
     else if($majorID == 2){

        /*
     Education:

            EL1000 English Composition I            
            ED3700 Child Development for Teachers
            ED3950 Creating Schools for a Just Society
            ED4050 Innovative Instructional Design and Assessment
            ED4121 Methods & Materials of Teaching Elementary Science Methods
            ED4122 Methods & Materials of Teaching Elementary Math Methods
            ED4200 Literacy for All Students
            ED4220 Language Arts in the Context of Childhood Education
            ED5925 Building a Classroom Community for All Learners

            EL2206 Science Fiction Literarure
            ML1100 Basic Spanish I
            ML1100 Basic Spanish II
            MA2090 Precalculus
            CP2120-2121 Principles of Chemistry I (With Lab)
     */
        

        $toReturn = array(

            "EL1000",            
            "ED3700",
            "ED3950",
            "ED4050",
            "ED4121",
            "ED4122",
            "ED4200",
            "ED4220",
            "ED5925",
            "EL2206",
            "ML1100",
            "ML1100",
            "MA2090",
            "CP2120",
            "CP2121"            
        );
 
        

        
     }
     else if($majorID == 3){

        /*
        Visual Arts:

            EL1000 English Composition I
            VA3100 Visual Culture – Warhol to Present
            VA3200 Art Tutorials I
            VA4200 Art Tutorials II
            VA5200 Art Tutorials III
            VA2010 Introduction to Creative Thinking
            VA2020 Basic Design
            VA2030 Drawing
            VA2045 Introduction to Color
            VA2500 Art History I: 19th Century Art 
            VA2510 Art History II: Modern Art:1900-1945
            VA3400 Digital Imaging
            VA2750 Sculpture I
            A3350 Topics In Contemporary Art
     */
        

        $toReturn = array(

            "EL1000",
            "VA3100",
            "VA3200",
            "VA4200",
            "VA5200",
            "VA2010",
            "VA2020",
            "VA2030",
            "VA2045",
            "VA2500",
            "VA2510",
            "VA3400",
            "VA2750"  
        );
 
        

        
     }
     else if($majorID == 4){

        /*
        Psychology:

            EL1000 English Composition I
            PY2010 Introduction to Psychology
            PY3010 Research Design & Analysis I
            PY4200 Research Design and Analysis II       
            PY3410 Cognitive Psychology
            PY3420 Learning & Motivation
            PY3610 Brain & Behavior
            PY3620 Drugs & Behavior
            PY3020 Health Psychology
            PY3310 Abnormal Human Behavior
     
     */
        

        $toReturn = array(

            "EL1000",
            "PY2010",
            "PY3010",
            "PY4200",     
            "PY3410",
            "PY3420",
            "PY3610",
            "PY3620",
            "PY3020",
            "PY3310"

            
                 
        );
 
        

        
     }
     else if($majorID == 5){

        /*
        EL1000 English Composition I
            HI2681 Introduction to European History
            AS2112 American People I
            HI3091 African Cultures
            HI2810 Geography, Earth, and People
            HI4001 Nineteenth Century
            HI3610 America’s African Heritage
            HI4062 Making History

           
     */
        

        $toReturn = array(

            "EL1000",
            "HI2681",
            "AS2112",
            "HI3091",
            "HI2810",
            "HI4001",
            "HI3610",
            "HI4062"
            

            
                 
        );
 
        

        
     }
     else if($majorID == 6){

        /*
        English:
            
            EL1000 English Composition I
            EL2206 Science Fiction Literarure
            EL3500 Literature Across Cultures I: Analysis & Interpretation
            EL3510 Literature Across Cultures II: Theory
            EL3800 English Literature I: Beowulf to 18th Century, inclusive of Shakespeare
            EL3561 Literatures of Europe Part II
            EL4312 Greek Mythology
            EL4800 Major Authors
        
            
            EL4050 Lesbian & Gay Literature
            EL4040 Black Women Writers
            EL3865 Literature of Asia
            EL4640 French Literature
            EL4650 Literature of Russia and Eastern Europe
     */
        

        $toReturn = array(
            "EL1000",
            "EL2206",
            "EL3500",
            "EL3510",
            "EL3800",
            "EL3561",
            "EL4312",
            "EL4800",         
            "EL4050",
            "EL4040",
            "EL3865",
            "EL4640",
            "EL4650"
            
            

            
                 
        );
 
        

        
     }
     else if($majorID == 7){

        /*
        BS2400-BS2401 Basic Biology I with Lab
            BS2410-BS2411 Basic Biology II with Lab
            CP2120-2121 & CP2130-2131 Principles of Chemistry I-II (with Labs)
            CP2220-2221 & CP2230-2231 Structure of Physics I-II (with Labs)
            BS4400 Cell Biology
            BS4460 Genetics
            BS3400 Vertebrate Physiology
            BS3520 Comparative Anatomy
            BS4440 Evolution
            BS4470 Ecology
     */
        

        $toReturn = array(
            "MA2090",
            "BS2400",
            "BS2401",
            "BS2410",
            "BS2411",
            "CP2120",
            "CP2121",
            "CP2220",
            "CP2221",
            "BS4400",
            "BS4460",
            "BS3400",
            "BS3520",
            "BS4440",
            "BS4470"
            
            

            
                 
        );
 
        

        
     }

     
     
    
    return $toReturn;

    }
    function createLibClassArray(){
        /*
        -Mathematic/CS: MA2090, MA2310, CS2511, CS2510
        -Education: ED3700, ED3820, ED3950 
        -Modern Languages: ML4220, ML1100, ML1101
        -English: EL1000, EL2206, EL4312, EL3865
        -Visual Arts: VA2010, VA2020, VA2030, VA3100
        -Psychology: PY2010, PY3410, PY3420
        -History: HI2681, AS2112, HI3091, HI2810, HI3002, HI3011, HI3021
        -Bio: BS2400-BS2401 , CP2220-CP2221, BS2410-BS2411 */
        return array(
            "MA2090",
            "ED3700",
            "ML4220",
            "EL1000",
            "VA2010",
            "PY2010",
            "HI2681",
            "BS2400",
            "BS2401",
            "MA2310",
            "ED3820",
            "ML1100",
            "EL2206",
            "VA2020",
            "PY3410",
            "AS2112",
            "CP2220",
            "CP2221",
            "CS2511",
            "ED3950",
            "ML1101",
            "EL4312",
            "VA2030",
            "PY3420",
            "HI3091",
            "BS2410",
            "BS2411",
            "CS2511",
            "EL3865",
            "VA3100",
            "HI2810",
            "HI3002",
            "HI3011",
            "HI3021"
        );
    }
    function createMinorClassArray($minorID){
        
        if ($minorID == -1){
            return array();
        }

        if($minorID = 1){
        return array(
            "CS2511",
            "CS2510",
            "MA2090",
            "MA2310",
            "MA3030",
            "CS3810",
            "CS4501"
        );
        }
    }

    


    function removeDuplicateCourses($majorArray, $minorArray){
        $toReturn = array();
        for($x = 0; $x < count($majorArray); $x++){
            for($y = 0; $y < count($minorArray); $y++){

                if($minorArray[$y] == $majorArray[$x]){
                    $minorArray[$y] = NULL;
                }
            }
        }
        for($y = 0; $y < count($minorArray); $y++){

            if($minorArray[$y] != NULL){
                array_push($toReturn, $minorArray[$y]);
            }
        }
        return $toReturn;

    }

    function addCourse($conn, $studentID,$CRN, $grades, $semesterStartDate){

        $sql = "INSERT INTO Enrollment VALUES($studentID, 
                            $CRN,
                             \"" . $grades[rand(0, count($grades)-1)] ."\",
                             \"". $semesterStartDate ."\")";
                             
        $result = mysqli_query($conn, $sql);

        $sql = "INSERT INTO studentHistory VALUES(
                            $CRN, 
                            $studentID,
                            'S')"; //CHANGE THIS BACK WHEN DONE
                             
        $result = mysqli_query($conn, $sql);



        
    }
    function findCourseSection($conn, $courseID, $semesterID, $timeslots){
        $sql = "select CRN from coursesection where courseID = '$courseID' && semesterID = $semesterID  && seatsAvailable > 0";
        for($x = 0; $x < count($timeslots); $x++){
            $sql = $sql . "&& timeslotID != " . $timeslots[$x];
        }
        $result = mysqli_query($conn, $sql);
        if($row = $result->fetch_row()){
            return $row[0];
        }
        return -1;


    }

    function checkPrerequisites($conn, $studentID, $semester, $courseID){
        //get all the prerequisites
        $prereqs = array();
        
        $sql = "SELECT prerequisitecourseID FROM prerequisite WHERE courseID = '$courseID'";
        $result = mysqli_query($conn, $sql);
        
        while($row = $result->fetch_row()){
            
            array_push($prereqs, $row[0]);
        }

        for($x = 0; $x < count($prereqs); $x++){
            $sql = "SELECT coursesection.CRN from enrollment 
                    LEFT JOIN coursesection ON coursesection.CRN = enrollment.CRN
                    WHERE enrollment.studentID = $studentID && coursesection.semesterID != $semester && courseID = \"" . $prereqs[$x] . "\"";
            $result = mysqli_query($conn, $sql);
            if($result->num_rows <= 0){
                return false;
            }
        }
        
    


        return true;

    }
    function findNextCourse($conn, $studentID, $semester, $timeslots, $coreClasses, $minorClasses, $libClasses){
        $coreClassesIndex = 0;
        $CRN = -1;

        while($coreClasses[$coreClassesIndex] == NULL && $coreClassesIndex < count($coreClasses)){
            $coreClassesIndex++;
        }
        //check prerequisites
        if(checkPrerequisites($conn, $studentID, $semester, $coreClasses[$coreClassesIndex])){
            $CRN = findCourseSection($conn, $coreClasses[$coreClassesIndex],$semester, $timeslots);
            if($CRN != -1){
                return $CRN;
    
            }
        }

        

        $minorClassesIndex = 0;
        while($minorClasses[$minorClassesIndex] == NULL && $minorClassesIndex < count($minorClasses)){
            $minorClassesIndex++;
        }
        //check prerequisites
        if(checkPrerequisites($conn, $studentID, $semester, $minorClasses[$minorClassesIndex])){
            $CRN = findCourseSection($conn, $minorClasses[$minorClassesIndex],$semester, $timeslots);
            if($CRN != -1){
                return $CRN;

            }
        }


        $libClassesIndex = 0;
        while($libClasses[$libClassesIndex] == NULL && $libClassesIndex < count($libClasses)){
            $libClassesIndex++;
        }
        
        $CRN = findCourseSection($conn, $libClasses[$libClassesIndex],$semester, $timeslots);
        return $CRN;

    }

    function setNull($conn,$CRN, $classes){

        $sql = "SELECT courseID FROM coursesection where CRN = $CRN"; //CHANGE THIS BACK WHEN DONE
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();

        for($x = 0; $x < count($classes); $x++){
            if($classes[$x] == $row[0]){
                $classes[$x] = NULL;
                break;
            }
        }

        return $classes;

    }
    

    

    /*
    info going in: studentID, start semester, major, minor

    flow of events
    1.Student has major? get list of required courses
        a. Core Courses
        b. required electives (just find the first one that pops up in a semester)
            i.in the case of any, just pick randomly
    2.Student has minor? get list of required courses
        a. Core Courses
        b. required electives (just find the first one that pops up in a semester)

    3.Add random liberal arts courses until filled (Bare minimum of one of each is required)
        -Mathematic/CS: MA2090, MA2310, CS2511, CS2510
        -Education: ED3700, ED3820, ED3950 
        -Modern Languages: ML4220, ML1100, ML1101
        -English: EL1000, EL2206, EL4312, EL3865
        -Visual Arts: VA2010, VA2020, VA2030, VA3100
        -Psychology: PY2010, PY3410, PY3420
        -History: HI2681, AS2112, HI3091, HI2810, HI3002, HI3011, HI3021
        -Bio: BS2400-BS2401 , CP2220-CP2221, BS2410-BS2411

    4.start with first semester
        a. Find all course sections for a given course in the semester
            -if full move on to another section for the same course
            -if doesn't exist send an error message
            -once found check for time conflicts
            -if all good then register to that course and increase seatsTaken, decrement seatsLeft
            -
        b.start with earliest major related courses
        c.if not full yet, go to earliest minor related courses
        d. if not full yet do general education
            i.start with the first in each department.
    5. If the following Requirements are not met and the semester != 1 then repeat 5
        -All core major courses are completed
        -All required elective major courses are completed
        -All liberal arts courses have been taken
        -a certain number of liberal arts credits depending on major
        -at least 120 total credits (filler courses)

    6. Set number of credits equal to course.credit + course.credit..., set creditsToGraduate
        -make sure to ignore courses in fall 2021 when calculating credit amount

    7.If graduating set status to graduated, otherwise dont
        


    



    the course order for each major:
    
        Math:

            MA2090 Precalculus
            CS2511 Computer Programming I
            MA2310 Calculus and Analytic Geometry I
            MA2320 Calculus and Analytic Geometry II
            MA3030 Discrete Mathematics
            MA3160 Linear Algebra
            MA3210 Intro. To Probability & Statistics
            MA3330 Calculus and Analytic Geometry III
            MA3520 Transition to Advanced Mathematics
            MA4360 Differential Equations
            MA5120 Abstract Algebra I
            MA5320 Advanced Calculus I

            Any 3
            MA4100 Number Theory
            MA4200 Probability
            MA4510 Geometry
            MA4910 Operations Research I
            MA4920 Operations Research II
            MA5230 Mathematical Statistics
            MA5380 Complex Analysis
            MA5510 Topology
        CS:
            
            CS2510 Computer Programming I
            CS2511 Computer Programming II
            MA2090 - Precalculus
            MA2310 - Calc & Analytic Geometry I
            MA3030 Discrete Mathematics
            MA3210 Intro. To Probability & Statistics
            MA4100 Number Theory
            CS3620 Computer Architecture I
            CS3810 Data Structures and Algorithms
            CS3911 C++ and Object-Oriented Programming
            CS4100 Technical Communications
            CS4501 Software Engineering
            CS4550 Database Management Systems
            CS4720 Internet and Web Technologies
            CS5910 System Design & Implementation

            Any 3
            CS4200 Mobile Programming via Android
            CS4400 Artificial Intelligence
            CS4705 Computer Security
            CS4710 Applied Cryptography
            CS5610 Operating Systems
            CS5710 Computer Networks
            CS5730 Computer Network Security
            CS5810 Data Mining

        Education:

            EL1000 English Composition I            
            ED3700 Child Development for Teachers
            ED3950 Creating Schools for a Just Society
            ED4050 Innovative Instructional Design and Assessment
            ED4121 Methods & Materials of Teaching Elementary Science Methods
            ED4122 Methods & Materials of Teaching Elementary Math Methods
            ED4200 Literacy for All Students
            ED4220 Language Arts in the Context of Childhood Education
            ED5925 Building a Classroom Community for All Learners

            EL2206 Science Fiction Literarure
            ML1100 Basic Spanish I
            ML1100 Basic Spanish II
            MA2090 Precalculus
            CP2120-2121 Principles of Chemistry I (With Lab)
        
        Visual Arts:

            EL1000 English Composition I
            VA3100 Visual Culture – Warhol to Present
            VA3200 Art Tutorials I
            VA4200 Art Tutorials II
            VA5200 Art Tutorials III
            VA2010 Introduction to Creative Thinking
            VA2020 Basic Design
            VA2030 Drawing
            VA2045 Introduction to Color
            VA2500 Art History I: 19th Century Art 
            VA2510 Art History II: Modern Art:1900-1945
            VA3400 Digital Imaging
            VA2750 Sculpture I
            A3350 Topics In Contemporary Art
            

        Psychology:

            EL1000 English Composition I
            PY2010 Introduction to Psychology
            PY3010 Research Design & Analysis I
            PY4200 Research Design and Analysis II       
            PY3410 Cognitive Psychology
            PY3420 Learning & Motivation
            PY3610 Brain & Behavior
            PY3620 Drugs & Behavior
            PY3020 Health Psychology
            PY3310 Abnormal Human Behavior

        History:

            EL1000 English Composition I
            HI2681 Introduction to European History
            AS2112 American People I
            HI3091 African Cultures
            HI2810 Geography, Earth, and People
            HI4001 Nineteenth Century
            HI3610 America’s African Heritage
            HI4062 Making History

        English:
            
            EL1000 English Composition I
            EL2206 Science Fiction Literarure
            EL3500 Literature Across Cultures I: Analysis & Interpretation
            EL3510 Literature Across Cultures II: Theory
            EL3800 English Literature I: Beowulf to 18th Century, inclusive of Shakespeare
            EL3561 Literatures of Europe Part II
            EL4312 Greek Mythology
            EL4800 Major Authors
        
            
            EL4050 Lesbian & Gay Literature
            EL4040 Black Women Writers
            EL3865 Literature of Asia
            EL4640 French Literature
            EL4650 Literature of Russia and Eastern Europe

        Bio:

            
            BS2400-BS2401 Basic Biology I with Lab
            BS2410-BS2411 Basic Biology II with Lab
            CP2120-2121 & CP2130-2131 Principles of Chemistry I-II (with Labs)
            CP2220-2221 & CP2230-2231 Structure of Physics I-II (with Labs)
            BS4400 Cell Biology
            BS4460 Genetics
            BS3400 Vertebrate Physiology
            BS3520 Comparative Anatomy
            BS4440 Evolution
            BS4470 Ecology

    */

    $conn = connectToDB();

    $grades = array(
        "A",
        "B",
        "C"
        
        
    );


    $majorID = 5;
    $minorID = -1;
    $startingSemester = 93;
    $sql = "SELECT undergradstudentID FROM undergradstudentmajor WHERE majorID = $majorID";
    $result = mysqli_query($conn, $sql);
    $studentArray = array();
    while($row = $result->fetch_row()){
        array_push($studentArray, $row[0]);
    }
    for($i = 0; $i < 100; $i++){
        echo "$i <br> <br>";
        
        if($i == 10 || $i == 20 || $i == 40 || $i == 60 || $i == 80 || $i == 90 || $i == 95){
            $startingSemester = incSemester($startingSemester);
        }
    
        $semester = $startingSemester;

        
    $studentID = $studentArray[$i];
    
    $sql = "SELECT minorID FROM undergradstudentminor WHERE undergradstudentid = $studentID";
    $result = mysqli_query($conn, $sql);
    $row = $result->fetch_row();
    $minorID = $row[0];
    $courseLoad = 16;

    $totalCredits = 0;
    
    $coreClasses = createMajorClassArray($majorID);
    $minorClasses = createMinorClassArray($minorID);
    $libClasses = createLibClassArray();
    if($minorID != -1){
        $minorClasses = removeDuplicateCourses($coreClasses, $minorClasses);
    }
    $libClasses = removeDuplicateCourses($coreClasses, $libClasses);
    $libClasses = removeDuplicateCourses($minorClasses, $libClasses);



    
    while($totalCredits < 120 && $semester != 2){
        
        //add classes until credits >= courseLoad
        $semesterCredits = 0;
        $timeslots = array();

        $courseCount = 0;

        $sql = "SELECT startDate FROM semester
            WHERE semesterID = $semester";
        $result = mysqli_query($conn, $sql);
        $row = $result->fetch_row();
        $semesterStartDate = $row[0];
        

        while($courseCount < 4){
            
            $CRN = findNextCourse($conn, $studentID, $semester, $timeslots, $coreClasses, $minorClasses, $libClasses);

            if($CRN == -1){
                echo "CRN was -1 with course number $courseCount from $semester <br>";
                $courseCount = 4;
                for($x = 0; $x < count($coreClasses); $x++){
                    if($coreClasses[$x] != NULL){
                        echo $coreClasses[$x] . " <br>";
                        break;
                    }
                }
                for($x = 0; $x < count($minorClasses); $x++){
                    if($minorClasses[$x] != NULL){
                        echo $minorClasses[$x] . " <br>";
                        break;
                    }
                }
                for($x = 0; $x < count($libClasses); $x++){
                    if($libClasses[$x] != NULL){
                        echo $libClasses[$x] . " <br>";
                        break;
                    }
                }
            }
            else{

                //add to course
            addCourse($conn, $studentID,$CRN, $grades, $semesterStartDate);

            //remove course once added
            $coreClasses = setNull($conn, $CRN, $coreClasses);
            if($minorID != -1){
                $minorClasses = setNull($conn, $CRN, $minorClasses);
            }
            $libClasses = setNull($conn, $CRN, $libClasses);


            //update timeslot
            $sql = "SELECT timeslotID FROM coursesection WHERE CRN = $CRN";
            $result = mysqli_query($conn, $sql);
            $row = $result->fetch_row();
            array_push($timeslots, $row[0]);

            //alter credits
            $semesterCredits = $semesterCredits+4;
            //
            
            //alter seatsAvailable and seatsLeft(do this last)
            $sql = "UPDATE coursesection SET seatsAvailable = seatsAvailable-1,  seatsTaken = seatsTaken+1 WHERE CRN = $CRN";
            $result = mysqli_query($conn, $sql);

            
            $courseCount++;
            }
            

        }
        
        
        if($semester != 1){
        $totalCredits += $semesterCredits;
        }
        //inc semester
        $semester = incSemester($semester);

    }


    echo "Credit Amount for student $i :  $totalCredits <br>";
    $sql = "UPDATE student SET numOfCredits = $totalCredits WHERE userID = $studentID";
    $result = mysqli_query($conn, $sql);

    if($totalCredits >=120){
        $sql = "UPDATE undergradstudent SET status = 'graduated' WHERE userID = $studentID";
    $result = mysqli_query($conn, $sql);
    }

    echo "missing classes <br>";
    for($x = 0; $x < count($coreClasses); $x++){
        if($coreClasses[$x] != NULL){
            echo $coreClasses[$x] . " <br>";
        }
    }

    


    }

    

    

    

    ?>  

</body>

</html>