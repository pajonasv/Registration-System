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
    if($majorID == "\"Mathematics, PhD\""){
        /*
        
    
    MA9000: Algebraic Topology
    MA9010: Differential Topology
    MA9020: Differential Geometry
    MA9030: Theory of Probability
    MA9040: Linear Algebra, Multivariable Calculus, and Modern Applications 

        */

       $toReturn = array(
        "MA9000",
        "MA9010",
        "MA9020",
        "MA9030",
        "MA9040"
       );

    
       
    }
    else if($majorID == "\"M.S. in Data Science\""){
        /*
        
    MA6510: Statistics I
    MA6520: Statistics II
    CS6010: Algorithms and Programming Techniques
    CS6020: Introduction to Databases
    CS6030: Data Warehousing
    CS6110: Data Analytics I
    CS6120: Data Analytics II
    CS7510: Communication and Presentation
    CS7910: Analytics Project I
    CS7920: Analytics Project II
    CS7800: Internship

        */

        $toReturn = array(
            "MA6510",
            "MA6520",
            "CS6010",
            "CS6020",
            "CS6030",
            "CS6110",
            "CS6120",
            "CS7510",
            "CS7910",
            "CS7920",
            "CS7800"
        );
 
     }
     else if($majorID == "\"Adolescence Education: Mathematics (7-12), M.A.T.\""){

        /*
     
    ED6000 Historical, Social, and Philosophical Foundations of Educations
    ED6001 Human Growth and Development
    ED6002 Foundations of Literacy
    ED6084 Methods and Materials of Teaching Mathematics
    ED6094 Literacy, Research & Technology in Mathematics
    ED6092 Student Teaching ( Mathematics)
    MA6100 Probability and Statistics
    MA6150 Geometry
    MA6200 Algebra
    MA6250 Analysis
    MA6400 Topics in Advanced Mathematics and Technology
    MA7500 Topics in Mathematics and Mathematics Education

     */
        

        $toReturn = array(
            "ED6000",
            "ED6001",
"ED6002",
"ED6084",
"ED6094",
"ED6092",
"MA6100",
"MA6150",
"MA6200",
"MA6250",
"MA6400",
"MA7500"
                    
        );
 
        

        
     }
     else if($majorID == "\"Mental Health Counseling, M.S.\""){

        /*
        
    MH6100 Professional Orientation and Ethics
    MH6110 Intro to Counseling Theory and Practice
    MH6120 Psychopathology
    MH6530 Principles and Techniques of Counseling
    MH6130 Psychosocial & Cultural Perspectives: Theory & Practice I
    MH6140 Practicum I
    MH6510 Assessment Techniques in Counseling
    MH6520 Multicultural Counseling Lab
    MH6540 Practicum II
    MH7500 Diagnosis and Treatment of Addictive Disorders
    MH6500 Lifespan Development
    MH7100 Counseling Children and Families
    MH7110 Group Counseling
    MH7120 Psychosocial & Cultural Perspectives: Theory & Practice II
    MH7130 Clinical Internship in Mental Health Counseling I
    MH7510 Career Development
    MH7520 Research Methods in Counseling
    MH7530 Clinical Internship in Mental Health Counseling II

     */
        

        $toReturn = array(
            "MH6100",
            "MH6110",
"MH6120",
"MH6530",
"MH6130",
"MH6140",
"MH6510",
"MH6520",
"MH6540",
"MH7500",
"MH6500",
"MH7100",
"MH7110",
"MH7120",
"MH7130",
"MH7510",
"MH7520",
"MH7530"
        
        );
 
        

        
     }
     else if($majorID == "\"Adolescence Education: English Language Arts (7-12), M.A.T.\""){

        /*

        
    ED6000 Historical, Social, and Philosophical Foundations of Education
    ED6001 Human Growth and Development
    ED6002 Foundations of Literacy
    ED6003 The Exceptional Learner
    ED6083 Discipline Specific Methodology: English
    ED6083 Discipline Specific Methodology: English
    ED6093 Discipline Specific Literacy: English
    EL6510 Foundations of U.S Literature
    EL6520 Foundations of English Literature
    EL6530 Topics in Multicultural Literatures
    EL6540 Topics in World Literature
    EL6550 Rhetoric and Composition
    EL7500 Literature in the Classroom

     */
        

        $toReturn = array(
            "ED6000",
            "ED6001",
            "ED6002",
            "ED6003",
            "ED6083",
            "ED6083",
            "ED6093",
            "EL6510",
            "EL6520",
            "EL6530",
            "EL6540",
            "EL6550",
            "EL7500"
                 
        );
 
        

        
     }
     else if($majorID == "\"Adolescence Education: Biology (7-12), M.A.T.\""){

        /*
        
           
    ED6000 Historical, Social, and Philosophical Foundations of Education
    ED6001 Human Growth and Development
    ED6002 Foundations of Literacy
    ED6003 The Exceptional Learner
    ED6900 Student Teaching
    ED6082 Methods and Materials of Teaching Science
    ED6092 Literacy, Research, & Technology in Science
    ED6250 Teaching the Nature and Development of Science
    BS6560 Current Topics in Molecular Biology and Biochemistry
    BS6590 Topics in Environmental Science
    CP6740 Topics in Earth and Space Science

     */
        

        $toReturn = array(
            
            "ED6000",
            "ED6001",
            "ED6002",
            "ED6003",
            "ED6900",
            "ED6082",
            "ED6092",
            "ED6250",
            "BS6560",
            "BS6590",
            "CP6740"
            
                 
        );
 
        

        
     }
     else if($majorID == "\"Biomedical Sciences, PhD\""){

        /*
        
    BS9000 Course on becoming a scientist
    BS9010 Quantitative Skills for the Biomedical Researcher I
    BS9020 Quantitative Skills for the Biomedical Researcher II
    BS9030 Responsible Conduct of Research (year 1)
    BS9040 Responsible Conduct of Research – Advanced (year 5)

     */
        

        $toReturn = array(
            "BS9000",
            "BS9010",
            "BS9020",
            "BS9030",
            "BS9040"
            
            

            
                 
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
            "CS2510",
            "EL3865",
            "VA3100",
            "HI2810",
            "HI3002",
            "HI3011",
            "HI3021"
        );
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
    function findNextCourse($conn, $studentID, $semester, $timeslots, $coreClasses){
        $coreClassesIndex = 0;
        $CRN = -1;

        while($coreClasses[$coreClassesIndex] == NULL && $coreClassesIndex < count($coreClasses)){
            $coreClassesIndex++;
        }
        //check prerequisites
        if(checkPrerequisites($conn, $studentID, $semester, $coreClasses[$coreClassesIndex])){
            $CRN = findCourseSection($conn, $coreClasses[$coreClassesIndex],$semester, $timeslots);
        }
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

    $conn = connectToDB();

    $grades = array(
        "A",
        "B",
        "C"
        
        
    );


    $majorID = "\"Biomedical Sciences, PhD\"";
    $startingSemester = 93;
    $sql = "SELECT userID FROM gradstudent WHERE gradProgram = $majorID";
    $result = mysqli_query($conn, $sql);
    $studentArray = array();
    while($row = $result->fetch_row()){
        array_push($studentArray, $row[0]);
    }
    for($i = 0; $i < count($studentArray); $i++){
        echo "$i <br> <br>";
        
        if($i == 5 || $i == 10 || $i == 15 || $i == 20 || $i == 30 || $i == 35 || $i == 45){
            $startingSemester = incSemester($startingSemester);
        }
    
        $semester = $startingSemester;

        
    $studentID = $studentArray[$i];
    
    $courseLoad = 12;

    $totalCredits = 0;
    
    $coreClasses = createMajorClassArray($majorID);

    
    while($totalCredits < count($coreClasses)*4 && $semester != 2){
        
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
            
            $CRN = findNextCourse($conn, $studentID, $semester, $timeslots, $coreClasses);

            if($CRN == -1){
                echo "CRN was -1 with course number $courseCount from $semester <br>";
                $courseCount = 4;
                for($x = 0; $x < count($coreClasses); $x++){
                    if($coreClasses[$x] != NULL){
                        echo $coreClasses[$x] . " <br>";
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