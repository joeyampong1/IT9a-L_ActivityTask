<?php
require 'db_connection.php';

// Add Patient
if (isset($_POST['add_patient'])) { 
    $full_name = $_POST['full_name'];
    $age = $_POST['age'];
    $gender = $_POST['gender'];
    $contact_number = $_POST['contact_number'];
    
    try {
       
        $stmt = $healthcare_db->prepare("INSERT INTO patient (full_name, age, gender, contact_number) VALUES (?, ?, ?, ?)");
        $stmt->execute([$full_name, $age, $gender, $contact_number]); 
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding patient: " . $e->getMessage();
    }
}

// Add Consultation 
if (isset($_POST['add_consultation'])) { 
    $patient_id = $_POST['patient_id']; 
    $doctor_name = $_POST['doctor_name'];
    $consultation_date = $_POST['consultation_date']; 
    $diagnosis = $_POST['diagnosis']; 
    $treatment = $_POST['treatment'];
    
    try {
       
        $stmt = $healthcare_db->prepare("INSERT INTO consultations (patient_id, doctor_name, consultation_date, diagnosis, treatment) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$patient_id, $doctor_name, $consultation_date, $diagnosis, $treatment]);
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error adding consultation: " . $e->getMessage();
    }
}
?>