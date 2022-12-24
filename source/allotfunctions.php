<?php
// Get Number Of Requests for a Particular Student
function getRequestCount($db)
{
  $hostel_name = substr($_SESSION['username'], -1);
  //$query_request_count = "Select * from cleanrequest cr inner join student s on cr.rollnumber=s.rollnumber where s.hostel='$hostel_name'";
  $query_request_count = "select * from cleanrequest";
  $result_request_count = mysqli_query($db, $query_request_count);
  $countRow = 0;
  if (mysqli_num_rows($result_request_count) > 0) {
    $countRow = mysqli_num_rows($result_request_count);
  }

  return $countRow;
}

// Get Number Of Complaints for a Particular Student
function getComplantCount($db)
{
  $hostel_name = substr($_SESSION['username'], -1);
  //$query_complaint_count = "Select * from complaints cr inner join student s on cr.rollnumber=s.rollnumber where s.hostel='$hostel_name'";
  $query_complaint_count = "select * from complaints";
  $result_complaint_count = mysqli_query($db, $query_complaint_count);
  $countRow = 0;
  if (mysqli_num_rows($result_complaint_count) > 0) {
    $countRow = mysqli_num_rows($result_complaint_count);
  }
  return $countRow;
}

// Get Number Of Suggestions for a Particular Student
function getSuggestionCount($db)
{
  $hostel_name = substr($_SESSION['username'], -1);
  //$query_suggestion_count = "Select * from suggestion cr inner join student s on cr.rollnumber=s.rollnumber where s.hostel='$hostel_name'";
  $query_suggestion_count = "select * from suggestion";
  $result_suggestion_count = mysqli_query($db, $query_suggestion_count);
  /*if(!$result_suggestion_count || mysqli_num_rows($result_suggestion_count) == 0){
      $countRow = mysqli_num_rows($result_suggestion_count);
  }   
  return $countRow;*/
  $countRow = 0;
  if (mysqli_num_rows($result_suggestion_count) > 0) {
    //$countRow = mysqli_fetch_assoc($result_suggestion_count);
    $countRow = mysqli_num_rows($result_suggestion_count);
  }
  return $countRow;
  /*if(mysqli_num_rows($result_suggestion_count)==1)
  {
    $count1=mysqli_fetch_assoc($result_suggestion_count);
  }
  return $count1;
*/
}

// Get Number Of Request, Housekeeper & Feedback Info
function getRequests($rollnumber, $db)
{
  // $hostel = substr($rollnumber, -1);

  // $query_request = "select cleanrequest.worker_id , cleanrequest.date, cleanrequest.cleaningtime, cleanrequest.req_status, cleanrequest.request_id, student.room, from cleanrequest Inner Join cleanrequest  on  cleanrequest.rollnumber = student.rollnumber
  //   Left Join housekeeper  on cleanrequest.worker_id = housekeeper.worker_id 
  //   Left Join feedback on feedback.request_id = cleanrequest.request_id
  //   where student.hostel = '$hostel' and 
  //   Order by cleanrequest.date desc";
    $query_request = "select cleanrequest.worker_id , cleanrequest.date, cleanrequest.cleaningtime, cleanrequest.req_status, cleanrequest.request_id, student.roomnumber as room, feedback.timein, feedback.timeout, feedback.rating, housekeeper.name from cleanrequest
    Inner Join student on student.rollnumber = cleanrequest.rollnumber
    Left Join housekeeper  on cleanrequest.worker_id = housekeeper.worker_id 
    Left Join feedback on feedback.request_id = cleanrequest.request_id
    Order by cleanrequest.date desc";
  // $query_request = "select * from cleanrequest";
  $result_request = mysqli_query($db, $query_request);
  return $result_request;
}

// Get Complaints in Detail
function getComplaints($username, $db)
{
  $hostel = substr($username, -1);

   $query_request = "select complaints.complaint, feedback.rating, cleanrequest.date, housekeeper.name, student.roomnumber from
   complaints Inner Join feedback on complaints.feedback_id = feedback.feedback_id
   Inner Join cleanrequest on feedback.request_id = cleanrequest.request_id
   Inner Join housekeeper on cleanrequest.worker_id = housekeeper.worker_id
   Inner Join student on complaints.rollnumber = student.rollnumber
   where student.hostel = '$hostel'
   Order by cleanrequest.date desc";
  // $query_request = "select * from complaints";
  echo mysqli_error($db);
  $result_request = mysqli_query($db, $query_request);
  return $result_request;
}

// Get Suggestion in Detail
function getSuggestions($username, $db)
{
  $hostel = substr($username, -1);

  $query_request = "select suggestion.suggestion, feedback.rating, cleanrequest.date, housekeeper.name, student.roomnumber 
    from suggestion
    Inner Join feedback on suggestion.feedback_id = feedback.feedback_id
    Inner Join cleanrequest  on feedback.request_id = cleanrequest.request_id
    Inner Join housekeeper on cleanrequest.worker_id = housekeeper.worker_id
    Inner Join student on suggestion.rollnumber = student.rollnumber where student.hostel = '$hostel'";
    echo mysqli_error($db);
  // $query_request = "select  * from suggestion";
  $result_request = mysqli_query($db, $query_request);
  return $result_request;
}
