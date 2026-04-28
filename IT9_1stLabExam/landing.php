<?php
require 'db_connection.php'; 
require 'insert.php';
require 'update.php';
require 'delete.php';
require 'select.php';


// Initialize variables 
if (!isset($patient)) $patient = [];
if (!isset($consultations)) $consultations = [];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Simple Health Care CRUD</title>
   
</head>
<body>
    <!-- MAIN CONTAINER -->
    <div class="main-container">

        <!-- HEADER - Full Width -->
        <div class="header">
            <h2> Health Care CRUD</h2>
        </div>
        
        <div class="tab_button">
        <button class="button">Patients</button>
        <button class="button">Consultations</button>
        </div>
        
        <!-- Patient Tab -->
        <div class="patient-section">
            <?php
            // CHECK IF EDIT MODE
            $editPatient = null;
            $editConsultation = null;
            

            if (isset($_GET['edit_patient'])) {
                $patient_id = $_GET['edit_patient'];
                $stmt = $healthcare_db->prepare("SELECT * FROM patient WHERE patient_id = ?");
                $stmt->execute([$patient_id]);
                $editPatient = $stmt->fetch(PDO::FETCH_ASSOC);
            }

            if (isset($_GET['edit_consultations'])) {
                $consultation_id = $_GET['edit_consultations'];
                $stmt = $healthcare_db->prepare("SELECT * FROM consultations WHERE consultation_id = ?");
                $stmt->execute([$consultation_id]);
                $editConsultation = $stmt->fetch(PDO::FETCH_ASSOC);
            }
            
            
            ?>

            <h3 class="section-title"><?= !empty($editPatient) ? '✏️ Update Customer' : '➕ Add New Customer' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editPatient)): ?>
                        <input type="hidden" name="patient_id" value="<?= htmlspecialchars($editPatient['patient_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Full Name:</label>
                        <input type="text" name="full_name" value="<?= !empty($editPatient) ? htmlspecialchars($editPatient['full_name']) : '' ?>" placeholder="Enter full name" required>
                    </div>

                    <div class="form-group">
                        <label> Age:</label>
                        <input type="number" name="age" value="<?= !empty($editPatient) ? htmlspecialchars($editPatient['age']) : '' ?>" placeholder="Enter  age" required>
                    </div>
                    <div class="form-group">
                        <label>Gender:</label>
                        <select name="gender" required>
                        <option value="" <?= (!isset($editPatient) || empty($editPatient['gender'])) ? 'selected' : '' ?>>Select Gender</option>
                        <option value="Male" <?= (isset($editPatient) && $editPatient['gender'] == 'Male') ? 'selected' : '' ?>>Male</option>
                        <option value="Female" <?= (isset($editPatient) && $editPatient['gender'] == 'Female') ? 'selected' : '' ?>>Female</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label>Contact Number:</label>
                        <input type="text" name="contact_number" value="<?= !empty($editPatient) ? htmlspecialchars($editPatient['contact_number']) : '' ?>" placeholder="Enter contact number" required>
                    </div>

                    <div class="btn-group">
                    <?php if (!empty($editPatient)): ?> 
                        <button type="submit" name="update_patient" class="btn btn-primary">Update Patient</button>
                        <a href="landing.php" class="btn btn-secondary">Cancel</a>
                    <?php else: ?>
                        <button type="submit" name="add_patient" class="btn btn-primary">Add Patient</button>
                    <?php endif; ?>
                    </div>
                </form>
            </div>

            <hr>

            <h3 class="section-title">Patient List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Full Name</th>
                            <th>Age</th>
                            <th>Gender</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($patient)): ?>
                            <?php foreach ($patient as $pat): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($pat['patient_id']) ?></strong></td>
                                <td><?= htmlspecialchars($pat['full_name']) ?></td>
                                <td><?= htmlspecialchars($pat['age']) ?></td>
                                <td><?= htmlspecialchars($pat['gender']) ?></td>
                                <td><?= htmlspecialchars($pat['contact_number']) ?></td>
                                <td class="action-links">
                                    <a href="?edit_patient=<?= $pat['patient_id'] ?>" class="action-link edit-link">Edit</a> 
                                    <a href="?delete_patient=<?= $pat['patient_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure?')">Delete</a> 
                                 </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="5" style="text-align: center;">No Patients found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>


             <!-- Consultations Tab -->
        <div class="consultations-section">
            <h3 class="section-title"><?= !empty($editConsultation) ? '✏️ Update Consultation' : '➕ Add New Consultation' ?></h3>

            <div class="form-container">
                <form method="POST">
                    <?php if (!empty($editConsultation)): ?>
                        <input type="hidden" name="consultation_id" value="<?= htmlspecialchars($editConsultation['consultation_id']) ?>">
                    <?php endif; ?>

                    <div class="form-group">
                        <label>Patient:</label>
                        <select name="patient_id" required>
                            <option value="">Select Patient</option>
                            <?php if (!empty($patient)): ?>
                                <?php foreach ($patient as $patients): ?>
                                <option value="<?= $patients['patient_id'] ?>" <?= (!empty($editConsultation) && $editConsultation['patient_id'] == $patients['patient_id']) ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($patients['full_name'] ) ?>
                                </option>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </select>
                    </div>


                    <div class="form-group">
                        <label>Doctor's Name:</label>
                        <input type="text" name="doctor_name" value="<?= !empty($editConsultation) ? htmlspecialchars($editConsultation['doctor_name']) : '' ?>" placeholder="Enter doctor's name" required>
                    </div>

                    <div class="form-group">
                        <label>Date:</label>
                        <input type="date" name="consultation_date" value="<?= !empty($editConsultation) ? htmlspecialchars($editConsultation['consultation_date']) : '' ?>" required>
                    </div>

                    <div class="form-group">
                        <label>Diagnosis:</label>
                        <input type="text" name="diagnosis" value="<?= !empty($editConsultation) ? htmlspecialchars($editConsultation['diagnosis']) : '' ?>" placeholder="Enter diagnosis" required>
                    </div>

                    <div class="form-group">
                        <label>Treatments:</label>
                        <input type="text" name="treatment" value="<?= !empty($editConsultation) ? htmlspecialchars($editConsultation['treatment']) : '' ?>" placeholder="Enter treatments" required>
                    </div>
 
                    <div class="btn-group">
                        <?php if (!empty($editConsultation)): ?>
                            <button type="submit" name="update_consultation" class="btn btn-primary">Update Consultation</button>
                            <a href="landing.php" class="btn btn-secondary">Cancel</a>
                        <?php else: ?>
                            <button type="submit" name="add_consultation" class="btn btn-primary">Add Consultation</button>
                        <?php endif; ?>
                    </div>
                </form>
            </div>

            <hr>

            <h3 class="section-title">Consultation List</h3>

            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Patient Name</th>
                            <th>Doctor's Name</th>
                            <th>Date</th>
                            <th>Diagnosis</th>
                            <th>Treatment</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php if (!empty($consultations)): ?>
                            <?php foreach ($consultations as $consult): ?>
                            <tr>
                                <td><strong>#<?= htmlspecialchars($consult['consultation_id']) ?></strong></td>
                                <td><?= htmlspecialchars($consult['full_name']) ?></td>
                                <td><?= htmlspecialchars($consult['doctor_name']) ?></td>
                                <td><?= htmlspecialchars($consult['consultation_date']) ?></td>
                                <td><?= htmlspecialchars($consult['diagnosis']) ?></td>
                                <td><?= htmlspecialchars($consult['treatment']) ?></td>
                                <td class="action-links">
                                    <a href="?edit_consultations=<?= $consult['consultation_id'] ?>" class="action-link edit-link">Edit</a>
                                    <a href="?delete_consultation=<?= $consult['consultation_id'] ?>" class="action-link delete-link" onclick="return confirm('Are you sure you want to delete this consultation?')">Delete</a>
                                </td>
                            </tr>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <tr>
                                <td colspan="7" style="text-align: center;">No consultations found</td>
                            </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
 </div>


       
</body>
</html>