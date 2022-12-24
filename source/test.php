<?php
session_start();
include_once 'db.php';
$roll = $_SESSION['rollnumber'];

  $curr_date = date('Y-m-d');
    
    // $q = "Select * from cleanrequest where rollnumber='$roll' and date='$curr_date' ";
    // $re=mysqli_query($db,$q);
    // $r=mysqli_fetch_assoc($re);
    // print_r($r);
    // while($r=mysqli_fetch_assoc($re))
?>

    <table class="table align-items-center table-flush">
                <thead class="thead-light">
                  <tr>
                    <th scope="col">Housekeeper</th>
                    <th scope="col">Date</th>
                    <th scope="col">Time Requested</th>
                    <th scope="col">Time In</th>
                    <th scope="col">Time Out</th>
                  </tr>
                </thead>
                <tbody>
                  <?php
                  $q = "Select cr.request_id as reqid, hk.worker_id,cr.req_status,hk.name,cr.date, cr.cleaningtime, fd.timein, fd.timeout from cleanrequest cr Left Join housekeeper hk on cr.worker_id=hk.worker_id Left Join feedback fd on cr.request_id = fd.request_id where cr.rollnumber='$roll' and date='2022-11-26'";
                  $re=mysqli_query($db,$q);
                  if (mysqli_num_rows($re) > 0) {
                    while ($row = mysqli_fetch_assoc($re)) {

                  ?>
                      <tr>
                        <th scope="row">
                          <?php
                          if ($row['worker_id'] == NULL && $row['req_status'] == 0) {
                            echo "<span style='color:#EE801A'>Not Alloted</span> - " . $row['reqid'];
                          } else if ($row['worker_id'] != NULL && $row['req_status'] == 1) {
                            echo $row['name'] . " - <span style='color:#2980b9'>Alloted</span> - " . $row['reqid'];
                          } else if ($row['worker_id'] != NULL && $row['req_status'] == 2) {
                            echo $row['name'] . " - <span style='color:#27ae60'>Served</span> - " . $row['reqid'];
                          }
                          ?>
                        </th>
                        <td>
                          <?php echo $row['date']; ?>
                        </td>
                        <td>
                          <?php
                          $cleaningtime = $row['cleaningtime'];
                          echo date('h:i a', strtotime($cleaningtime));
                          ?>
                        </td>
                        <td>
                          <?php
                          if ($row['timein'] == NULL) {
                            echo "<span style='color:#EE801A'>--</span>";
                          } else if ($row['timein'] != NULL) {
                            $timei = $row['timein'];
                            echo date('h:i a', strtotime($timei));
                          }
                          ?>
                        </td>
                        <td>
                          <?php
                          if ($row['timeout'] == NULL) {
                            echo "<span style='color:#EE801A'>--</span>";
                          } else if ($row['timeout'] != NULL) {
                            $timeo = $row['timeout'];
                            echo date('h:i a', strtotime($timeo));
                          }
                          ?>
                        </td>
                      </tr>
                  <?php }
                  } ?>
                </tbody>
              </table>
