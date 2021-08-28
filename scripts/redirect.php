
<html>

<body>

<?php 
	include '../global.php';
	if($_POST["webpage"] == "loginPage"){
		header("Location:  $baseURL/login/login.php"); 
	}
	else if($_POST["webpage"] == "academicCalendar"){
		header("Location:  $baseURL/academicCalendar/academicCalendar.php"); 
	}
	else if($_POST["webpage"] == "catalog"){
		header("Location: $baseURL/catalog/catalog.php");
	}
	else if($_POST["webpage"] == "homepage"){
		header("Location: $baseURL/homepage/homepage.php");
	}
	else if($_POST["webpage"] == "masterSchedule"){
		header("Location: $baseURL/masterSchedule/masterSchedule.php");
	}
	else if($_POST["webpage"] == "logout"){
		header("Location: $baseURL/scripts/logout.php");
	}
	else if($_POST["webpage"] == "changePass"){
		header("Location: $baseURL/changePassword/changePassword.php");
	}

	//Student stuff:
	else if($_POST["webpage"] == "studentHomepage"){
		header("Location: $baseURL/Student/studentHomepage.php");
	}
	else if($_POST["webpage"] == "addClass"){
		header("Location: $baseURL/Student/addCourseSection.php");
	}
	else if($_POST["webpage"] == "dropCourseSection"){
		header("Location: $baseURL/Student/dropCourseSection.php");
	}
	else if($_POST["webpage"] == "editMajors"){
		header("Location: $baseURL/Student/editMajors.php");
	}
	else if($_POST["webpage"] == "editMinor"){
		header("Location: $baseURL/Student/editMinor.php");
	}
	else if($_POST["webpage"] == "viewAdvisors"){
		header("Location: $baseURL/Student/viewAdvisors.php");
	}
	else if($_POST["webpage"] == "viewCourseList"){
		header("Location: $baseURL/Student/viewCourseList.php");
	}
	else if($_POST["webpage"] == "viewDegreeAudit"){
		header("Location: $baseURL/Student/viewDegreeAudit.php");
	}
	else if($_POST["webpage"] == "studentViewHolds"){
		header("Location: $baseURL/Student/studentViewHolds.php");
	}
	else if($_POST["webpage"] == "viewMasterSchedule"){
		header("Location: $baseURL/Student/viewMasterSchedule.php");
	}
	else if($_POST["webpage"] == "viewTranscript"){
		header("Location: $baseURL/Student/viewTranscript.php");
	}
	else if($_POST["webpage"] == "viewMyCourses"){
		header("Location: $baseURL/Student/myCourses.php");
	}
	else if($_POST["webpage"] == "degreeAudit"){
		header("Location: $baseURL/scripts/degreeAudit.php");
	}
	else if($_POST["webpage"] == "changeGradProgram"){
		header("Location: $baseURL/Student/changeGradProgram.php");
	}
	
	//End of student

	//Faculty stuff:
	else if($_POST["webpage"] == "facultyHomepage"){
		header("Location: $baseURL/Faculty/facultyHomepage.php");
	}
	else if($_POST["webpage"] == "editGrade"){
		header("Location: $baseURL/Faculty/editGrade.php");
	}
	else if($_POST["webpage"] == "coursesTaught"){
		header("Location: $baseURL/Faculty/coursesTaught.php");
	}
	else if($_POST["webpage"] == "adviseesList"){
		header("Location: $baseURL/Faculty/adviseesList.php");
	}
	else if($_POST["webpage"] == "viewStudentTranscript"){
		header("Location: $baseURL/Faculty/viewStudentTranscript.php");
	}
	else if($_POST["webpage"] == "viewStudentDegreeAudit"){
		header("Location: $baseURL/Faculty/viewStudentDegreeAudit.php");
	}
	else if($_POST["webpage"] == "viewCourseSectionStudentList"){
		header("Location: $baseURL/Faculty/viewCourseSectionStudentList.php");
	}
	//End of faculty stuff.

	//Admin stuff:
	//case 0
	else if($_POST["webpage"] == "adminHomepage"){
		header("Location: $baseURL/Admin/adminHomepage.php");
	}

	//case 1
	else if($_POST["webpage"] == "addStudentAccount"){
		header("Location: $baseURL/Admin/addStudentAccount.php");
	}

	//case 2
	else if($_POST["webpage"] == "updateAccount"){
		header("Location: $baseURL/Admin/updateAccount.php");
	}
	
	//case 3
	else if($_POST["webpage"] == "addFacultyAccount"){
		header("Location: $baseURL/Admin/addFacultyAccount.php");
	}
	
	
	//case 5
	else if($_POST["webpage"] == "addResearcherAccount"){
		header("Location: $baseURL/Admin/addResearcherAccount.php");
	}
	
	//case 7
	else if($_POST["webpage"] == "addAdminAccount"){
		header("Location: $baseURL/Admin/addAdminAccount.php");
	}
	
	//case 9
	else if($_POST["webpage"] == "removeAccount"){
		header("Location: $baseURL/Admin/removeAccount.php");
	}
	
	//case 10
	else if($_POST["webpage"] == "assignFacultyAdvisor"){
		header("Location: $baseURL/Admin/assignFacultyAdvisor.php");
	}
	
	//case 11
	else if($_POST["webpage"] == "removeFacultyAdvisor"){
		header("Location: $baseURL/Admin/removeFacultyAdvisor.php");
	}

	//case 12
	else if($_POST["webpage"] == "listAdvisors"){
		header("Location: $baseURL/Admin/viewListAdvisors.php");
	}
	
	//case 13
	else if($_POST["webpage"] == "listUnderGradStudents"){
		header("Location: $baseURL/Admin/viewListUndergradStudents.php");
	}
	
	//case 14
	else if($_POST["webpage"] == "listGradStudents"){
		header("Location: $baseURL/Admin/viewListGradStudents.php");
	}

	//case 15
	else if($_POST["webpage"] == "addCourseSection"){
		header("Location: $baseURL/Admin/addCourseSection.php");
	}

	//case 16
	else if($_POST["webpage"] == "updateCourseSection"){
		header("Location: $baseURL/Admin/updateCourseSection.php");
	}

	else if($_POST["webpage"] == "updateCourseSectionDetails"){
		header("Location: $baseURL/Admin/updateCourseSectionDetails.php");
	}

	//case 17
	else if($_POST["webpage"] == "removeCourseSection"){
		header("Location: $baseURL/Admin/removeCourseSection.php");
	}

	else if($_POST["webpage"] == "removeCourseSectionWithDetails"){
		header("Location: $baseURL/Admin/removeCourseSectionWithDetails.php");
	}

	//case 18
	else if($_POST["webpage"] == "addHold"){
		header("Location: $baseURL/Admin/addHold.php");
	}

	//case 25
	else if($_POST["webpage"] == "viewHoldForStudent"){
		header("Location: $baseURL/Admin/viewHold.php");
	}

	//case 19
	else if($_POST["webpage"] == "removeHold"){
		header("Location: $baseURL/Admin/removeHold.php");
	}

	//case 20
	else if($_POST["webpage"] == "addCoursePrerequisite"){
		header("Location: $baseURL/Admin/addCoursePrerequisite.php");
	}

	//case 21
	else if($_POST["webpage"] == "removeCoursePrerequisite"){
		header("Location: $baseURL/Admin/removeCoursePrerequisite.php");
	}
	
	//case 22
	else if($_POST["webpage"] == "listCourses"){
		header("Location: $baseURL/Admin/viewListCourses.php");
	}

	//case 23
	else if($_POST["webpage"] == "registerStudentToCourse"){
		header("Location: $baseURL/Admin/registerStudentToCourse.php");
	}
	//case 26
	else if($_POST["webpage"] == "searchUsers"){
		header("Location: $baseURL/Admin/searchUsers/searchUsers.php");
	}
	//case 27
	else if($_POST["webpage"] == "updateAddDropWindow"){
		header("Location: $baseURL/Admin/updateAddDropWindow.php");
	}
	//case 28
	else if($_POST["webpage"] == "updateGradeSubmissionWindow"){
		header("Location: $baseURL/Admin/updateGradeSubmissionWindow.php");
	}
	else if($_POST["webpage"] == "AdminDegreeAudit"){
		header("Location: $baseURL/Admin/viewStudentDegreeAudit.php");
	}
	else if($_POST["webpage"] == "AdminTranscript"){
		header("Location: $baseURL/Admin/viewStudentTranscript.php");
	}

	else if($_POST["webpage"] == "EditStudentsMajors"){
		header("Location: $baseURL/Admin/editStudentsMajors.php");
	}
	else if($_POST["webpage"] == "EditStudentsMinor"){
		header("Location: $baseURL/Admin/editStudentsMinor.php");
	}
	else if($_POST["webpage"] == "addCourse"){
		header("Location: $baseURL/Admin/addCourse.php");
	}
	else if($_POST["webpage"] == "deleteCourse"){
		header("Location: $baseURL/Admin/deleteCourse.php");
	}
	else if($_POST["webpage"] == "adminEditGrade"){
		header("Location: $baseURL/Admin/adminEditGrade.php");
	}
	else if($_POST["webpage"] == "viewAllRooms"){
		header("Location: $baseURL/Admin/viewAllRooms.php");
	}
	//End of admin stuff.

	//Researcher stuff
	else if($_POST["webpage"] == "ResearcherHomepage"){
		header("Location: $baseURL/Researcher/researcherHomepage.php");
	}
	else if($_POST["webpage"] == "viewCurrentlyEnrolled"){
		header("Location: $baseURL/Researcher/viewCurrentlyEnrolled.php");
	}
	else if($_POST["webpage"] == "viewAllMajors"){
		header("Location: $baseURL/Researcher/viewAllMajors.php");
	}

	else if($_POST["webpage"] == "viewAllMinors"){
		header("Location: $baseURL/Researcher/viewAllMinors.php");
	}

	else if($_POST["webpage"] == "listStudentByGenderMale"){
		header("Location: $baseURL/Researcher/viewStudentGender.php?gender=Male");
	}

	else if($_POST["webpage"] == "listStudentByGenderFemale"){
		header("Location: $baseURL/Researcher/viewStudentGender.php?gender=Female");
	}

	else if($_POST["webpage"] == "viewGraduates"){
		header("Location: $baseURL/Researcher/viewGraduates.php");
	}
	
	else if($_POST["webpage"] == "viewAverageUndergradGPA"){
		header("Location: $baseURL/Researcher/viewAverageUndergradGPA.php");
	}
	else if($_POST["webpage"] == "viewStatistics"){
		header("Location: $baseURL/Researcher/Statistics/statistics.php");
	}
	else if($_POST["webpage"] == "viewAnonymousData"){
		header("Location: $baseURL/Researcher/searchUsers/searchUsers.php");
	}

	//End of Researcher Department stuff

	else{
		echo "bad redirect, webpage variable was" . $_POST["webpage"];
	}	

	die();
?>
</body>
</html>