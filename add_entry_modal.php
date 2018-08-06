<!-- Modal that appears when you click the + ADD ENTRY button -->
<div id="add_entry_modal" class="modal" style='display:none;'>  
    <div style='display:block;' class='outside_of_modal'></div>
    
    <div class='centering-modal'>

        <div class='moveable_modal' style='height:370px;'id='moveable_add_entry_modal'>

            <div id='moveable_add_entry_modalheader' class='modal_header'>
                <p id='myModal_text' class='modal_header_text'>Add New Entry</p>
            </div>

            <!-- use php to echo the employee id -->    
            <input form='new_entry' name='emp_id' id='emp_id' value=<?php echo $emp_id; ?> type='hidden'>

            <div style='height:50px;'>
                <p style='float:left;margin-left:20px;padding:0;margin-top:20px;'>Enter Date</p>
                <p style='float:left;margin-left:108px;padding:0;margin-top:20px;'>Enter Start</p>
                <p style='float:left;margin-left:73px;padding:0;margin-top:20px;'>Enter Finish</p>
            </div>

            
            <div style='height:20px;'>
                <!-- start date -->
                <input name='date' id='date' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 140px;' type=date>
                <input name='start' value='10:00'id='start' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select id='start_diem' name='start_diem' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option>PM</option>
                </select>
                <!-- end date -->
                <input name='end' value='2:00'id='end' form='new_entry' style='padding: 0 0 0 4px; float:left; margin-left:20px; margin-top:-15px; height:30px; width: 60px;' type=text>
                <!-- select AM or PM -->
                <select name='end_diem'form='new_entry' id='end_diem' style='padding: 0 0 0 4px; float:left; margin-left:5px; margin-top:-15px; height:34px; width: 40px;'>
                    <option>AM</option>
                    <option selected>PM</option>
                </select>
                <!-- options button -->
            </div>

            <!-- select properties -->
            <div style='height:50px; margin-left:20px;'>
                <p style='float:left;padding:0;margin-top:20px;'>Select Project</p>
            </div>

            <div style='height:20px; margin-left:20px;'>
                <select id='project_id' name='project_id' form='new_entry' style='float:left;padding: 0 0 0 4px; margin-top:-15px; height:34px; width: 148px;'>
                    <!-- start php code -->
                    <?php 
                        if (isset($_SESSION['u_id'])) {
                            // Get the company name 
                            $org_id = $_SESSION['u_org_id'];
                            // Get all the managers from that company
                            $sql = "SELECT * FROM projects WHERE org_id = '$org_id' AND status = 'active';";
                            // Put the result into $result
                            $result = mysqli_query($conn, $sql);
                            // Put each employee into an option 
                            while ($row = $result->fetch_assoc()) {
                                // Get the employee's email
                                $project_name = $row['project_name'];
                                // Get the employee's id
                                $project_id = $row['project_id'];
                                // Put the employee in an option
                                echo "<option data-name='$project_name' value='$project_id'>$project_name</option>";
                            }
                        } elseif (isset($_SESSION['m_id'])) {
                            // Get all assignmenst to that manager
                            $sql = "SELECT * FROM assignment_managers WHERE manager_id = '$manager_id';";
                            // Put the result into $result
                            $result3 = mysqli_query($conn, $sql);

                            while ($row4 = $result3->fetch_assoc()) {

                                if ($row4['project_id'] != null) {
                                    // Get the project id
                                    $project_id = $row4['project_id'];
                                    // Get all of the assignments for that manager
                                    $sql = "SELECT * FROM projects WHERE project_id = '$project_id' AND org_id = '$org_id'";
                                    // Put the result into $result
                                    $result = mysqli_query($conn, $sql);
                                    while ($row5 = $result->fetch_assoc()) {
                                        
                                        $project_name = $row5['project_name'];
                                        
                                        echo "<option value='$project_id' data-name='$project_name'>$project_name</option>";
                                        
                                    }
                                }
                            }
                        }

                    ?>
                    <!-- end php code -->
                </select>
            </div>

            <!-- Description -->
            <div style='height:50px; margin-left:20px;'>
                <p style='float:left;padding:0;margin-top:20px;'>Description</p>
            </div>

            <!-- text area for description field -->
            <div style='height:66px; margin-left:20px;'>
                <textarea form='new_entry' name='desciption' id='description' class='textarea-style-1'></textarea>
            </div>

            <div class='space20'>
            </div>

            <div style='height:54px; margin-left:20px;'>
                <!-- save button -->
                <button form='new_entry' type='sumbit' id='save_new_entry' name='project_submit' class='button-style-4-2 right'>Save
                </button>
                
                <!-- cancel button -->
                <button id='cancel_add_entry' class='button-style-4-2 right'>Cancel
                </button>
            </div>

            <!-- <form id='new_entry' method='POST' action='add_new_entry_to_employee.php'>
            </form>    -->
            
        </div>
    </div>
</div>