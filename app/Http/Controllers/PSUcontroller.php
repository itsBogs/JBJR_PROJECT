<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PSUcontroller extends Controller
{
    public function welcome() {
        return "Welcome, Jayson Bogs!";
    }

    public function mission() {
    return "The Pangasinan State University shall provide a human-centric, resilient, and sustainable academic environment<br><br>
            to produce dynamic, responsive, and future-ready individuals<br><br>
            capable of meeting the requirements of the local and global communities and industries.";
}

public function vission() {
    return "To become a leading industry-driven State University<br><br>
            in the ASEAN region by 2030.";
}

public function eom() {
    return "The Pangasinan State University shall be recognized as an ASEAN premier state university<br><br>
            that provides quality education and satisfactory service delivery through:<br><br>
            Instruction<br>
            Research<br>
            Extension<br>
            Production<br><br>

            We commit our expertise and resources to produce professionals<br><br>
            who meet the expectations of the industry and other interested parties<br><br>
            in the national and international community.<br><br>

            We shall continuously improve our operations through systems and process innovations<br><br>
            guided by ethical standards, intellectual property, and technology transfer policies<br><br>
            in response to changing educational, scientific, and technological developments<br><br>
            for social responsiveness and in support of the institution’s strategic direction.";
}
public function author() {
    return "February 21, 2026 <br><br>
            Jayson Bogs J. Ramos.<br><br>
            PANGASINAN STATE UNIVERSITY WEBSITE<br><br>";
}







    // public function student($name, $course) {
    //     return "$name |$course.";
    
    // }

    public function student($name, $course) {
        return "Student: {$name} | Course: {$course}";
    }

    
}       