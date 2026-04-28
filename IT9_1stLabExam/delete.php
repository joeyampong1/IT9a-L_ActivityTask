<?php
require 'db_connection.php';

// Delete Patient
if (isset($_GET['delete_patient'])) {
    $patient_id = $_GET['delete_patient'];
    
    try {
        // For foreign key 
        $stmt = $healthcare_db->prepare("DELETE FROM consultations WHERE patient_id = ?");
        $stmt->execute([$patient_id]);
        
        // for patient table
        $stmt = $healthcare_db->prepare("DELETE FROM patient WHERE patient_id = ?");
        $stmt->execute([$patient_id]);
        
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting patient: " . $e->getMessage();
    }
}

// Delete Consultation
if (isset($_GET['delete_consultation'])) {
    $consultation_id = $_GET['delete_consultation'];
    
    try {
        $stmt = $healthcare_db->prepare("DELETE FROM consultations WHERE consultation_id = ?");
        $stmt->execute([$consultation_id]);
        
        header("Location: landing.php");
        exit();
    } catch (PDOException $e) {
        echo "Error deleting consultation: " . $e->getMessage();
    }
}
?>