<?php

use App\Models\User;
use Illuminate\Support\Facades\Auth;
$user = User::find(Auth::id());

?>



<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Competition Registration</title>
  <!-- Bootstrap 5 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Bootstrap Icons -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
  <!-- AOS Animation Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
  <!-- Custom CSS -->
  <style>
    :root {
      --primary-color: #C42B4A;
      --primary-dark: #3a56d4;
      --secondary-color: #7209b7;
      --accent-color: #4cc9f0;
      --success-color: #06d6a0;
      --warning-color: #ffd166;
      --danger-color: #ef476f;
      --light-color: #f8f9fa;
      --dark-color: #212529;
      --transition-slow: 0.5s;
      --transition-medium: 0.3s;
      --transition-fast: 0.15s;
    }
    
     /* Change input field background color */
        

    @font-face {
      font-family: 'Poppins';
      src: url('https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap');
    }

    body {
      font-family: 'Poppins', sans-serif;
      background: linear-gradient(135deg, #f5f7ff 0%, #ffffff 100%);
      min-height: 100vh;
      position: relative;
      overflow-x: hidden;
      color: #2d3748;
    }
    .head{
        background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
    }
    /* Enhanced Animated Background */
    .animated-background {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      z-index: -1;
      overflow: hidden;
      background: linear-gradient(125deg, #f0f4ff 0%, #e6f2ff 40%, #f5f0ff 100%);
    }

    /* Animated Gradient Mesh */
    .gradient-mesh {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      opacity: 0.7;
      background: 
        radial-gradient(circle at 20% 30%, rgba(76, 201, 240, 0.15) 0%, rgba(76, 201, 240, 0) 25%),
        radial-gradient(circle at 80% 20%, rgba(114, 9, 183, 0.15) 0%, rgba(114, 9, 183, 0) 25%),
        radial-gradient(circle at 40% 80%, rgba(67, 97, 238, 0.15) 0%, rgba(67, 97, 238, 0) 25%),
        radial-gradient(circle at 70% 65%, rgba(6, 214, 160, 0.15) 0%, rgba(6, 214, 160, 0) 25%);
      animation: gradientShift 20s ease infinite alternate;
    }

    @keyframes gradientShift {
      0% {
        background-position: 0% 0%;
      }
      100% {
        background-position: 100% 100%;
      }
    }

    /* Animated Shapes */
    .animated-background .shape {
      position: absolute;
      filter: blur(60px);
      opacity: 0.4;
      animation: floatShape 20s infinite ease-in-out;
    }

    .shape-1 {
      top: -10%;
      right: -5%;
      width: 60vw;
      height: 60vw;
      background: linear-gradient(45deg, #4361ee, #7209b7);
      border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
      animation-duration: 25s;
    }

    .shape-2 {
      bottom: -15%;
      left: -10%;
      width: 70vw;
      height: 70vw;
      background: linear-gradient(45deg, #4cc9f0, #4361ee);
      border-radius: 60% 40% 30% 70% / 60% 30% 70% 40%;
      animation-delay: -5s;
      animation-duration: 30s;
    }

    .shape-3 {
      top: 30%;
      right: 10%;
      width: 40vw;
      height: 40vw;
      background: linear-gradient(45deg, #06d6a0, #4cc9f0);
      border-radius: 30% 70% 70% 30% / 30% 30% 70% 70%;
      animation-delay: -10s;
      animation-duration: 20s;
    }

    .shape-4 {
      top: 40%;
      left: 5%;
      width: 30vw;
      height: 30vw;
      background: linear-gradient(45deg, #ffd166, #ef476f);
      border-radius: 70% 30% 50% 50% / 40% 60% 40% 60%;
      animation-delay: -7s;
      animation-duration: 22s;
    }

    @keyframes floatShape {
      0% {
        transform: translate(0, 0) rotate(0deg) scale(1);
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
      }
      25% {
        border-radius: 60% 40% 40% 60% / 60% 40% 60% 40%;
      }
      50% {
        transform: translate(50px, -30px) rotate(10deg) scale(1.1);
        border-radius: 30% 70% 50% 50% / 30% 50% 50% 70%;
      }
      75% {
        border-radius: 50% 50% 30% 70% / 70% 30% 70% 30%;
      }
      100% {
        transform: translate(0, 0) rotate(0deg) scale(1);
        border-radius: 40% 60% 70% 30% / 40% 50% 60% 50%;
      }
    }

    /* Floating Particles */
    .particles {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      overflow: hidden;
      z-index: 0;
    }

    .particle {
      position: absolute;
      border-radius: 50%;
      opacity: 0.6;
      animation: particle-animation var(--transition-slow) infinite linear;
    }

    @keyframes particle-animation {
      0% {
        transform: translateY(100vh) rotate(0deg);
        opacity: 0;
      }
      20% {
        opacity: 0.6;
      }
      80% {
        opacity: 0.6;
      }
      100% {
        transform: translateY(-20vh) rotate(360deg);
        opacity: 0;
      }
    }

    /* Animated Grid Pattern */
    .grid-pattern {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-size: 40px 40px;
      background-image: 
        linear-gradient(to right, rgba(67, 97, 238, 0.05) 1px, transparent 1px),
        linear-gradient(to bottom, rgba(67, 97, 238, 0.05) 1px, transparent 1px);
      animation: gridMove 15s linear infinite;
    }

    @keyframes gridMove {
      0% {
        background-position: 0 0;
      }
      100% {
        background-position: 40px 40px;
      }
    }

    /* Animated Dots Pattern */
    .dots-pattern {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-image: radial-gradient(rgba(67, 97, 238, 0.1) 2px, transparent 2px);
      background-size: 30px 30px;
      animation: dotsMove 20s linear infinite;
    }

    @keyframes dotsMove {
      0% {
        background-position: 0 0;
      }
      100% {
        background-position: 30px 30px;
      }
    }

    /* Parallax Effect */
    .parallax-layer {
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      will-change: transform;
    }

    .parallax-layer-1 {
      transform: translateZ(-100px) scale(1.5);
    }

    .parallax-layer-2 {
      transform: translateZ(-50px) scale(1.25);
    }

    .parallax-layer-3 {
      transform: translateZ(0) scale(1);
    }

    /* Header Styles */
    .header {
      background: var(--primary-color);
      position: relative;
      overflow: hidden;
      padding: 5rem 0;
      margin-bottom: 3rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
    }

    .header::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%23ffffff' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
      opacity: 0.5;
    }

    .header-content {
      position: relative;
      z-index: 1;
    }

    .header-title {
      font-weight: 800;
      color: white;
      text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
      animation: fadeInDown 1s ease-out;
      margin-bottom: 1rem;
    }

    .header-subtitle {
      color: rgba(255, 255, 255, 0.9);
      font-weight: 300;
      animation: fadeInUp 1s ease-out 0.3s both;
      max-width: 600px;
      margin: 0 auto;
    }

    .header-wave {
      position: absolute;
      bottom: 0;
      left: 0;
      width: 100%;
      overflow: hidden;
      line-height: 0;
    }

    .header-wave svg {
      position: relative;
      display: block;
      width: calc(100% + 1.3px);
      height: 70px;
    }

    .header-wave .shape-fill {
      fill: #FFFFFF;
    }

    /* Deadline Banner */
    .deadline-banner {
      display: inline-block;
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      border-radius: 50px;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1), 
                  inset 0 0 0 1px rgba(255, 255, 255, 0.5);
      padding: 1rem 2rem;
      margin-bottom: 3rem;
      transform: translateY(-50px);
      animation: float-banner 5s ease-in-out infinite;
    }

    @keyframes float-banner {
      0%, 100% {
        transform: translateY(-50px);
      }
      50% {
        transform: translateY(-60px);
      }
    }

    .deadline-banner .icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 50%;
      color: white;
      margin-right: 1rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .deadline-text {
      font-weight: 600;
      color: var(--dark-color);
    }

    .deadline-date {
      font-weight: 700;
      color: var(--primary-color);
      position: relative;
      display: inline-block;
    }

    .deadline-date::after {
      content: '';
      position: absolute;
      bottom: -2px;
      left: 0;
      width: 100%;
      height: 2px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      transform-origin: right;
      transform: scaleX(0);
      transition: transform 0.3s ease;
    }

    .deadline-banner:hover .deadline-date::after {
      transform-origin: left;
      transform: scaleX(1);
    }

    /* Tab Styling */
    .nav-tabs-container {
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 0.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 
                  inset 0 0 0 1px rgba(255, 255, 255, 0.5);
      margin-bottom: 2rem;
    }
    .nashadow {
       
      backdrop-filter: blur(10px);
      border-radius: 1rem;
      padding: 0.5rem;
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 
                  inset 0 0 0 1px rgba(255, 255, 255, 0.5);
      margin-bottom: 2rem;
    }

    .nav-tabs {
      border: none;
      gap: 0.5rem;
    }

    .nav-tabs .nav-link {
      border: none;
      border-radius: 0.75rem;
      color: var(--dark-color);
      padding: 0.75rem 1.5rem;
      font-weight: 500;
      transition: all var(--transition-medium) ease;
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .nav-tabs .nav-link::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      z-index: -1;
      opacity: 0;
      transform: translateY(100%);
      transition: all var(--transition-medium) ease;
    }

    .nav-tabs .nav-link.active {
      color: white;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
    }

    .nav-tabs .nav-link.active::before {
      opacity: 1;
      transform: translateY(0);
    }

    .nav-tabs .nav-link:not(.active):hover {
      background: rgba(67, 97, 238, 0.1);
      transform: translateY(-3px);
    }

    .nav-tabs .nav-link .icon {
      margin-right: 0.5rem;
      transition: transform var(--transition-medium) ease;
    }

    .nav-tabs .nav-link:hover .icon {
      transform: scale(1.2);
    }

    /* Card Styling */
    .card {
      border: none;
      border-radius: 1.5rem;
      overflow: hidden;
      box-shadow: 0 20px 60px rgba(0, 0, 0, 0.1);
      background: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      transition: transform var(--transition-medium) ease, 
                  box-shadow var(--transition-medium) ease;
    }

    .card:hover {
      transform: translateY(-5px);
      box-shadow: 0 30px 70px rgba(0, 0, 0, 0.15);
    }

    .card-header.primary-header {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      padding: 2rem;
      position: relative;
      overflow: hidden;
    }

    .card-header.primary-header::before {
      content: '';
      position: absolute;
      top: -50%;
      left: -50%;
      width: 200%;
      height: 200%;
      background: radial-gradient(circle, rgba(255,255,255,0.2) 0%, rgba(255,255,255,0) 60%);
      animation: pulse 5s infinite linear;
    }

    @keyframes pulse {
      0% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.5;
      }
      50% {
        transform: translate(-50%, -50%) scale(1.5);
        opacity: 0.2;
      }
      100% {
        transform: translate(-50%, -50%) scale(1);
        opacity: 0.5;
      }
    }

    .card-header.light-header {
      background: linear-gradient(135deg, #f0f4ff, #eef1ff);
      padding: 2rem;
    }

    .card-body {
      padding: 2rem;
    }

    /* Form Section Styling */
    .form-section {
      border-radius: 1.25rem;
      padding: 2rem;
      margin-bottom: 2rem;
      background: rgba(255, 255, 255, 0.7);
      backdrop-filter: blur(5px);
      box-shadow: 0 10px 30px rgba(0, 0, 0, 0.05), 
                  inset 0 0 0 1px rgba(255, 255, 255, 0.5);
      transition: transform var(--transition-medium) ease, 
                  box-shadow var(--transition-medium) ease;
      position: relative;
      overflow: hidden;
    }

    .form-section::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 5px;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      transform: scaleX(0);
      transform-origin: left;
      transition: transform var(--transition-medium) ease;
    }

    .form-section:hover {
      transform: translateY(-5px);
      box-shadow: 0 15px 40px rgba(0, 0, 0, 0.1);
    }

    .form-section:hover::before {
      transform: scaleX(1);
    }

    .section-blue {
      background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
    }

    .section-purple {
      background: linear-gradient(135deg, rgba(114, 9, 183, 0.05), rgba(76, 201, 240, 0.05));
    }

    .section-teal {
      background: linear-gradient(135deg, rgba(76, 201, 240, 0.05), rgba(67, 97, 238, 0.05));
    }

    .section-title {
      font-size: 1.25rem;
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: var(--dark-color);
      display: flex;
      align-items: center;
      position: relative;
    }

    .section-title .icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 12px;
      color: white;
      margin-right: 1rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
      transition: transform var(--transition-medium) ease;
    }


    .button {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 200px;
      height: 40px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      border-radius: 12px;
      color: white;
      margin-right: 1rem;
      box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
      transition: transform var(--transition-medium) ease;
    }

    .form-section:hover .section-title .icon {
      transform: rotateY(180deg);
    }

    /* Form Controls */
    .form-label {
      font-weight: 500;
      color: var(--dark-color);
      margin-bottom: 0.5rem;
      transition: color var(--transition-fast) ease;
    }

    .form-control-container {
      position: relative;
      margin-bottom: 1.5rem;
    }

    .form-control, .form-select {
      height: 3.5rem;
      padding: 0.75rem 1rem 0.75rem 3rem;
      border: 2px solid rgba(0, 0, 0, 0.05);
      border-radius: 1rem;
      background-color: rgba(255, 255, 255, 0.8);
      backdrop-filter: blur(5px);
      transition: all var(--transition-medium) ease;
      font-size: 1rem;
      box-shadow: 0 5px 15px rgba(0, 0, 0, 0.03);
    }

    .form-control:focus, .form-select:focus {
      border-color: var(--primary-color);
      box-shadow: 0 5px 20px rgba(67, 97, 238, 0.2);
      background-color: white;
      outline: none;
    }

    .form-control-container:focus-within .form-label {
      color: var(--primary-color);
    }

    .input-icon {
      position: absolute;
      left: 1rem;
      top: 72%;
      transform: translateY(-50%);
      color: var(--primary-color);
      opacity: 0.7;
      transition: all var(--transition-medium) ease;
      font-size: 1.25rem;
    }

    .form-control-container:focus-within .input-icon {
      transform: translateY(-50%) scale(1.2);
      opacity: 1;
    }

    /* Upload Area */
    .upload-area {
      border: 2px dashed rgba(67, 97, 238, 0.3);
      border-radius: 1.25rem;
      padding: 2.5rem 1.5rem;
      text-align: center;
      cursor: pointer;
      transition: all var(--transition-medium) ease;
      background: linear-gradient(135deg, rgba(67, 97, 238, 0.05), rgba(114, 9, 183, 0.05));
      position: relative;
      overflow: hidden;
    }

    .upload-area::before {
      content: '';
      position: absolute;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: linear-gradient(135deg, rgba(67, 97, 238, 0.1), rgba(114, 9, 183, 0.1));
      transform: translateY(100%);
      transition: transform var(--transition-medium) ease;
      z-index: 0;
    }

    .upload-area:hover::before {
      transform: translateY(0);
    }

    .upload-area:hover {
      border-color: var(--primary-color);
      box-shadow: 0 10px 30px rgba(67, 97, 238, 0.1);
      transform: translateY(-5px);
    }

    .upload-icon {
      display: inline-flex;
      align-items: center;
      justify-content: center;
      width: 80px;
      height: 80px;
      border-radius: 24px;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      color: white;
      margin-bottom: 1.5rem;
      box-shadow: 0 10px 20px rgba(67, 97, 238, 0.2);
      position: relative;
      z-index: 1;
      transition: all var(--transition-medium) ease;
    }

    .upload-area:hover .upload-icon {
      transform: scale(1.1);
    }

    .upload-icon i {
      font-size: 2rem;
    }

    .upload-text {
      font-weight: 600;
      color: var(--primary-color);
      margin-bottom: 0.5rem;
      position: relative;
      z-index: 1;
    }

    .upload-subtext {
      color: var(--dark-color);
      opacity: 0.7;
      font-size: 0.875rem;
      position: relative;
      z-index: 1;
    }

    /* Submit Button */
    .btn-submit-container {
      position: relative;
      margin-top: 3rem;
      padding-bottom: 1rem;
    }

    .btn-submit {
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      background-size: 200% auto;
      color: white;
      border: none;
      border-radius: 1rem;
      padding: 1.25rem 2.5rem;
      font-size: 1.25rem;
      font-weight: 600;
      transition: all var(--transition-medium) ease;
      box-shadow: 0 10px 30px rgba(67, 97, 238, 0.3);
      position: relative;
      overflow: hidden;
      z-index: 1;
    }

    .btn-submit::before {
      content: '';
      position: absolute;
      top: 0;
      left: -100%;
      width: 100%;
      height: 100%;
      background: linear-gradient(90deg, rgba(255,255,255,0) 0%, rgba(255,255,255,0.2) 50%, rgba(255,255,255,0) 100%);
      transition: all var(--transition-medium) ease;
      z-index: -1;
    }

    .btn-submit:hover {
      background-position: right center;
      box-shadow: 0 15px 40px rgba(67, 97, 238, 0.4);
      transform: translateY(-5px);
    }

    .btn-submit:hover::before {
      animation: shine 1.5s infinite;
    }

    @keyframes shine {
      0% {
        left: -100%;
      }
      100% {
        left: 100%;
      }
    }

    .btn-submit i {
      margin-right: 0.75rem;
      transition: transform var(--transition-medium) ease;
    }

    .btn-submit:hover i {
      transform: rotate(360deg);
    }

    /* Progress Bar */
    .progress-container {
      position: relative;
      height: 10px;
      background-color: rgba(67, 97, 238, 0.1);
      border-radius: 5px;
      overflow: hidden;
      margin-bottom: 2rem;
    }

    .progress-bar {
      position: absolute;
      top: 0;
      left: 0;
      height: 100%;
      background: linear-gradient(90deg, var(--primary-color), var(--secondary-color));
      border-radius: 5px;
      transition: width var(--transition-medium) ease;
    }

    /* Footer */
    .footer {
      background: linear-gradient(to bottom, rgba(255, 255, 255, 0.8), rgba(240, 247, 255, 0.9));
      backdrop-filter: blur(10px);
      border-top: 1px solid rgba(67, 97, 238, 0.1);
      padding: 3rem 0;
      position: relative;
      z-index: 1;
      margin-top: 5rem;
    }

    .footer-logo {
      width: 60px;
      height: 60px;
      color: var(--primary-color);
      margin-right: 1rem;
      transition: transform var(--transition-medium) ease;
    }

    .footer-logo:hover {
      transform: rotate(360deg);
    }

    .footer-title {
      font-weight: 700;
      color: var(--primary-color);
      margin-bottom: 0.25rem;
    }

    .footer-subtitle {
      color: var(--dark-color);
      opacity: 0.7;
    }

    .footer-copyright {
      color: var(--dark-color);
      opacity: 0.7;
    }

    /* Animation Keyframes */
    @keyframes fadeInDown {
      from {
        opacity: 0;
        transform: translateY(-20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeInUp {
      from {
        opacity: 0;
        transform: translateY(20px);
      }
      to {
        opacity: 1;
        transform: translateY(0);
      }
    }

    @keyframes fadeIn {
      from {
        opacity: 0;
      }
      to {
        opacity: 1;
      }
    }

    /* Enhanced Responsive Adjustments */
    @media (max-width: 1200px) {
      .shape-1, .shape-2, .shape-3, .shape-4 {
        width: 50vw;
        height: 50vw;
      }
    }

    @media (max-width: 992px) {
      .header {
        padding: 4rem 0;
      }
      
      .header-title {
        font-size: 2.5rem;
      }
      
      .card-header.primary-header,
      .card-header.light-header,
      .card-body {
        padding: 1.5rem;
      }
      
      .form-section {
        padding: 1.75rem;
      }
    }

    @media (max-width: 768px) {
      .header {
        padding: 3rem 0;
      }
      
      .header-title {
        font-size: 2rem;
      }
      
      .header-wave svg {
        height: 40px;
      }
      
      .deadline-banner {
        padding: 0.75rem 1.5rem;
        margin-bottom: 2rem;
      }
      
      .deadline-banner .icon {
        width: 35px;
        height: 35px;
      }
      
      .nav-tabs .nav-link {
        padding: 0.5rem 1rem;
        font-size: 0.9rem;
      }
      
      .form-section {
        padding: 1.5rem;
        margin-bottom: 1.5rem;
      }
      
      .section-title {
        font-size: 1.1rem;
      }
      
      .section-title .icon {
        width: 35px;
        height: 35px;
      }
      
      .upload-icon {
        width: 60px;
        height: 60px;
      }
      
      .upload-icon i {
        font-size: 1.5rem;
      }
      
      .btn-submit {
        padding: 1rem 2rem;
        font-size: 1.125rem;
      }
    }

    @media (max-width: 576px) {
      .header {
        padding: 2.5rem 0;
      }
      
      .header-title {
        font-size: 1.75rem;
      }
      
      .header-subtitle {
        font-size: 1rem;
      }
      
      .deadline-banner {
        padding: 0.5rem 1rem;
        transform: translateY(-30px);
      }
      
      .deadline-banner .icon {
        width: 30px;
        height: 30px;
        margin-right: 0.5rem;
      }
      
      .deadline-text, .deadline-date {
        font-size: 0.9rem;
      }
      
      .nav-tabs .nav-link {
        padding: 0.4rem 0.75rem;
        font-size: 0.8rem;
      }
      
      .nav-tabs .nav-link .icon {
        margin-right: 0.3rem;
      }
      
      .form-section {
        padding: 1.25rem;
        margin-bottom: 1.25rem;
      }
      
      .section-title {
        font-size: 1rem;
        margin-bottom: 1rem;
      }
      
      .section-title .icon {
        width: 30px;
        height: 30px;
        margin-right: 0.75rem;
      }
      
      .form-control, .form-select {
        height: 3rem;
        font-size: 0.9rem;
      }
      
      .upload-area {
        padding: 1.5rem 1rem;
      }
      
      .upload-icon {
        width: 50px;
        height: 50px;
        margin-bottom: 1rem;
      }
      
      .upload-icon i {
        font-size: 1.25rem;
      }
      
      .upload-text {
        font-size: 0.9rem;
      }
      
      .upload-subtext {
        font-size: 0.75rem;
      }
      
      .btn-submit {
        padding: 0.75rem 1.5rem;
        font-size: 1rem;
        width: 100%;
      }
      
      /* Optimize animations for mobile */
      .animated-background .shape {
        filter: blur(40px);
      }
      
      @keyframes floatShape {
        0%, 100% {
          transform: translate(0, 0) rotate(0deg) scale(1);
        }
        50% {
          transform: translate(20px, -10px) rotate(5deg) scale(1.05);
        }
      }
      
      /* Reduce particle count on mobile */
      .particle:nth-child(n+20) {
        display: none;
      }
    }

    /* Loading Animation */
    .loading-overlay {
      position: fixed;
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background-color: rgba(255, 255, 255, 0.9);
      backdrop-filter: blur(10px);
      display: flex;
      align-items: center;
      justify-content: center;
      z-index: 9999;
      transition: opacity var(--transition-medium) ease, visibility var(--transition-medium) ease;
    }

    .loading-spinner {
      width: 80px;
      height: 80px;
      position: relative;
    }

    .loading-spinner:before,
    .loading-spinner:after {
      content: '';
      position: absolute;
      border-radius: 50%;
      animation: pulse-ring 1.5s linear infinite;
    }

    .loading-spinner:before {
      width: 100%;
      height: 100%;
      box-shadow: 0 0 0 0 rgba(67, 97, 238, 0.7);
      animation: pulse-ring 2s linear infinite;
    }

    .loading-spinner:after {
      width: 80%;
      height: 80%;
      top: 10%;
      left: 10%;
      background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
      animation: pulse-dot 1.5s ease-in-out infinite;
    }

    @keyframes pulse-ring {
      0% {
        transform: scale(0.5);
        opacity: 0.5;
      }
      80%, 100% {
        transform: scale(1.5);
        opacity: 0;
      }
    }

    @keyframes pulse-dot {
      0% {
        transform: scale(0.8);
      }
      50% {
        transform: scale(1);
      }
      100% {
        transform: scale(0.8);
      }
    }

    /* Success Animation */
    .success-checkmark {
      width: 80px;
      height: 80px;
      margin: 0 auto;
      position: relative;
      display: none;
    }

    .success-checkmark .check-icon {
      width: 80px;
      height: 80px;
      position: relative;
      border-radius: 50%;
      box-sizing: content-box;
      border: 4px solid var(--success-color);
    }

    .success-checkmark .check-icon::before {
      top: 3px;
      left: -2px;
      transform: rotate(45deg);
      transform-origin: 100% 50%;
      animation: checkmark-top 0.4s ease;
    }

    .success-checkmark .check-icon::after {
      top: 0;
      left: 30px;
      transform: rotate(-45deg);
      transform-origin: 0% 50%;
      animation: checkmark-bottom 0.4s ease 0.4s forwards;
    }

    .success-checkmark .check-icon::before,
    .success-checkmark .check-icon::after {
      content: '';
      height: 4px;
      background-color: var(--success-color);
      position: absolute;
      display: block;
      z-index: 10;
    }

    @keyframes checkmark-top {
      0% {
        width: 0;
        opacity: 1;
      }
      100% {
        width: 25px;
        opacity: 1;
      }
    }

    @keyframes checkmark-bottom {
      0% {
        width: 0;
        opacity: 1;
      }
      100% {
        width: 50px;
        opacity: 1;
      }
    }

    /* Fallbacks for older browsers */
    @supports not (backdrop-filter: blur(10px)) {
      .deadline-banner,
      .nav-tabs-container,
      .card,
      .form-section,
      .loading-overlay {
        background-color: rgba(255, 255, 255, 0.95);
      }
    }
  </style>
</head>
<body>
  <!-- Loading Overlay -->
  <div class="loading-overlay" id="loadingOverlay">
    <div class="loading-spinner"></div>
  </div>

  <!-- Animated Background -->
  <div class="animated-background">
    <div class="gradient-mesh"></div>
    <div class="grid-pattern"></div>
    <div class="dots-pattern"></div>
    <div class="parallax-layer parallax-layer-1"></div>
    <div class="parallax-layer parallax-layer-2"></div>
    <div class="parallax-layer parallax-layer-3"></div>
    <div class="shape shape-1"></div>
    <div class="shape shape-2"></div>
    <div class="shape shape-3"></div>
    <div class="shape shape-4"></div>
  </div>

  <!-- Particles -->
  <div class="particles" id="particles"></div>

  <!-- Header -->


  <!-- Main Content -->
  <main class="container  py-md-5 position-relative">
    <div class="row justify-content-center">
      <div class="col-md-10 col-lg-8">
        
      <h4 class="text-center py-4 text-white head nashadow">
        <span>{{ $competition->main_name }}</span>
        <br>
       <!-- <span> Office name</span>-->
        </h4>
        
        <!-- Progress Bar -->
        
        
        <!-- Tabs -->
        <div class="nav-tabs-container" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
          <ul class="nav nav-tabs justify-content-center" id="formTabs" role="tablist">
            <li class="nav-item" role="presentation">
              <button class="nav-link d-flex align-items-center" id="curriculum-tab" data-bs-toggle="tab" data-bs-target="#curriculum" type="button" role="tab" aria-controls="curriculum" aria-selected="false">
                <span class="icon"><i class="bi bi-book"></i></span>
                <span class="d-none d-sm-inline">Curriculum</span>
                <span class="d-inline d-sm-none">Curr.</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link d-flex align-items-center" id="rules-tab" data-bs-toggle="tab" data-bs-target="#rules" type="button" role="tab" aria-controls="rules" aria-selected="false">
                <span class="icon"><i class="bi bi-list-check"></i></span>
                <span class="d-none d-sm-inline">Rules</span>
                <span class="d-inline d-sm-none">Rules</span>
              </button>
            </li>
            <li class="nav-item" role="presentation">
              <button class="nav-link active d-flex align-items-center" id="form-tab" data-bs-toggle="tab" data-bs-target="#form" type="button" role="tab" aria-controls="form" aria-selected="true">
                <span class="icon"><i class="bi bi-pencil-square"></i></span>
                <span class="d-none d-sm-inline">Registration</span>
                <span class="d-inline d-sm-none">Reg.</span>
              </button>
            </li>
          </ul>
        </div>
<div class="m-0"></div>
      
        <!-- Tab Content -->
        <div class="tab-content" id="formTabsContent">
          <!-- Curriculum Tab -->
          <div class="tab-pane fade" id="curriculum" role="tabpanel" aria-labelledby="curriculum-tab">
            <div class="card" data-aos="fade-up" data-aos-duration="1000">
              <div class="card-header light-header">
                <h3 class="card-title fw-bold text-primary">Curriculum</h3>
                <p class="card-subtitle text-muted mb-0">Competition curriculum details and learning objectives</p>
              </div>
              <div class="card-body p-4">
                
                @if (empty($competition->curriculum))
                        <p class="text-primary">There is no curriculum available.</p>
                    @else
                    <div style="text-align:center;">
                        <button class="tab-btn button  {{ empty($competition->curriculum) ? 'disabled' : '' }}"
                            onclick="{{ !empty($competition->curriculum) ? "window.location.href='" . url('public/' . $competition->curriculum) . "'" : '' }}"
                            title="{{ empty($competition->curriculum) ? 'No curriculum file available for this record.' : '' }}">
                        Download
                        </button>
                        <button class="tab-btn button  {{ empty($competition->curriculum) ? 'disabled' : '' }}"
                                onclick="{{ !empty($competition->curriculum) ? "window.location.href='" . url('public/' . $competition->curriculum) . "'" : '' }}"
                                title="{{ empty($competition->curriculum) ? 'No curriculum file available for this record.' : '' }}">
                            View
                        </button>
                    </div>
                @endif
              </div>
            </div>
          </div>
          
          <!-- Rules Tab -->
          <div class="tab-pane fade" id="rules" role="tabpanel" aria-labelledby="rules-tab">
            <div class="card" data-aos="fade-up" data-aos-duration="1000">
              <div class="card-header light-header">
                <h3 class="card-title fw-bold text-primary">Rules</h3>
                <p class="card-subtitle text-muted mb-0">Competition rules and guidelines</p>
              </div>
              <div class="card-body p-4">
                    @if (empty($competition->rules))
                        <p class="text-primary">There is no rules available.</p>
                    @else
                    <div style="text-align:center;">
                        <button class="tab-btn button  {{ empty($competition->rules) ? 'disabled' : '' }}"
                                onclick="{{ !empty($competition->rules) ? "window.location.href='" . url('public/' . $competition->rules) . "'" : '' }}"
                                title="{{ empty($competition->rules) ? 'No rules file available for this record.' : '' }}">
                            Download
                        </button>
                        <button class="tab-btn button {{ empty($competition->rules) ? 'disabled' : '' }}"
                                onclick="{{ !empty($competition->rules) ? "window.location.href='" . url('public/' . $competition->rules) . "'" : '' }}"
                                title="{{ empty($competition->rules) ? 'No rules file available for this record.' : '' }}">
                            View
                        </button>
                    </div>    
                @endif
              </div>
            </div>
          </div>
          
          <!-- Form Tab -->
          <div class="tab-pane fade show active" id="form" role="tabpanel" aria-labelledby="form-tab">
            <div class="card" data-aos="fade-up" data-aos-duration="1000">
              <div class="card-header primary-header text-center">
                <h3 class="card-title fw-bold fs-4 mb-1">To Register This Competition</h3>
                <p class="card-subtitle text-white-500 mb-0 mt-2">Due Date & Time :{{$competition->end_date}}</p>
              </div>
              <div class="card-body p-4">
                <form id="competitionForm" method="POST" action="{{ route('poetry.competition.apply') }}" class="mt-3" enctype="multipart/form-data">
                 @csrf
                  <!-- Personal Information Section -->
                  <div class="form-section section-blue" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="100">
                    <h4 class="section-title">
                      <div class="icon">
                        <i class="bi bi-person-fill"></i>
                      </div>
                      Personal Information
                    </h4>
                    <input type="hidden" value="{{ $competition->id }}" name="competition_id">
                    <div class="row g-4">
                      <div class="col-md-6">
                        <div class="form-control-container">
                          <label for="fullName" class="form-label">Full name (English)</label>
                          <input type="text" value="{{ old('name') }}" class="form-control" id="fullName" name="name" placeholder="Enter your full name" required>
                          <i class="bi bi-person input-icon"></i>
                        </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-control-container">
                          <label for="fullName" class="form-label">Full name (Dhivehi)</label>
                          <input type="text" value="{{ old('name_Dhivehi') }}" class="form-control" id="fullName" name="name_Dhivehi" placeholder="Enter your full name">
                          <i class="bi bi-person input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-12">
                        <div class="form-control-container">
                          <label for="idPassport" class="form-label">ID Card / Passport #</label>
                          <input type="text" value="{{ old('id_card') }}" class="form-control" id="idPassport" name="id_card" placeholder="Enter your ID or passport number" required>
                          <i class="bi bi-credit-card input-icon"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Address Section -->
                  <div class="form-section section-purple" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200">
                    <h4 class="section-title">
                      <div class="icon">
                        <i class="bi bi-geo-alt-fill"></i>
                      </div>
                      Address Details
                    </h4>
                    
                    <div class="row g-4">
                      <div class="col-12">
                        <div class="form-control-container">
                          <label for="permanentAddress" class="form-label">Permanent Address</label>
                          <input type="text" value="{{ old('permanent_address') }}" class="form-control" id="permanentAddress" name="permanent_address" placeholder="Enter your permanent address" required>
                          <i class="bi bi-house input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-12">
                        <div class="form-control-container">
                          <label for="currentAddress" class="form-label">Current Address</label>
                          <input type="text" value="{{ old('current_address') }}" class="form-control" id="currentAddress" name="current_address" placeholder="Enter your current address" required>
                          <i class="bi bi-geo-alt input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="islandCity" class="form-label">Island / City</label>
                          <input type="text" value="{{ old('city') }}" class="form-control" id="islandCity" name="city" placeholder="Enter your island or city" required>
                          <i class="bi bi-pin-map input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="dob" class="form-label">Date of Birth</label>
                          <input type="date" value="{{ old('dob') }}" class="form-control" id="dob" name="dob" required>
                          <i class="bi bi-calendar3 input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="age" class="form-label">Age</label>
                          <input type="number" value="{{ old('age') }}" class="form-control" id="age" name="age" placeholder="Your age" required>
                          <i class="bi bi-123 input-icon"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Additional Information Section -->
                  <div class="form-section section-purple" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="300">
                    <h4 class="section-title">
                      <div class="icon">
                        <i class="bi bi-building"></i>
                      </div>
                      Additional Information
                    </h4>
                    
                    <div class="row g-4">
                      <div class="col-12">
                        <div class="form-control-container">
                          <label for="school" class="form-label">Behalf of any office or School (Dhivehi)</label>
                          <input type="text" value="{{ old('organization') }}" class="form-control" id="school" name="organization" placeholder="Enter your school or office" required>
                          <i class="bi bi-building input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-control-container">
                          <label for="parentName" class="form-label">Parent name (Dhivehi)</label>
                          <input type="text" value="{{ old('parent_name') }}" class="form-control" id="parentName" name="parent_name" placeholder="Enter parent's name">
                          <i class="bi bi-people input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <div class="form-control-container">
                          <label for="phone" class="form-label">Phone number (Dhivehi)</label>
                          <input type="tel" value="{{ old('number') }}" class="form-control" id="phone" name="number" placeholder="Enter your phone number" required>
                          <i class="bi bi-telephone input-icon"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Categories Section -->
                  <div class="form-section section-teal" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="400">
                    <h4 class="section-title">
                      <div class="icon">
                        <i class="bi bi-list-check"></i>
                      </div>
                      Competition Categories
                    </h4>
                    
                    <div class="row g-4">
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="ageCategory1" class="form-label">Age Category</label>
                          <select name="age_category" class="form-select" id="ageCategory1" required>
                            <option selected disabled value="">Select Age Category</option>
                            @foreach ($age_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                          </select>
                          <i class="bi bi-filter input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="ageCategory2" class="form-label">Perform Option</label>
                          <select name="side_category" class="form-select" id="ageCategory2" required>
                            <option selected disabled value="">Perform Option</option>
                            @foreach ($side_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                          </select>
                          <i class="bi bi-filter input-icon"></i>
                        </div>
                      </div>
                      
                      <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="ageCategory3" class="form-label">Method of Perform</label>
                          <select name="read_category" class="form-select" id="ageCategory3" required>
                            <option selected disabled value="">Method of Perform</option>
                            @foreach ($read_categories as $entry)
                                <option {{ old('age_category') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->name }}</option>
                            @endforeach
                          </select>
                          <i class="bi bi-filter input-icon"></i>
                        </div>
                      </div>
                    </div>

                    <div class="row g-4">
                        <div class="col-md-4">
                        <div class="form-control-container">
                          <label for="poetry3" class="form-label">Poetry</label>
                          <select name="poetry_id" class="form-select" id="ageCategory3" required>
                            <option selected disabled value="">Select Poetry</option>
                            @foreach ($poetries as $entry)
                                <option {{ old('poetry') == $entry->id ? 'Selected' : ''  }} value="{{ $entry->id }}">{{ $entry->poetry_name }}</option>
                            @endforeach
                          </select>
                          <i class="bi bi-filter input-icon"></i>
                        </div>
                      </div>
                    </div>


                  </div>
                  
                  <!-- Upload Section -->
                  <div class="form-section section-blue" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="500">
                    <h4 class="section-title">
                      <div class="icon">
                        <i class="bi bi-upload"></i>
                      </div>
                      Document Upload
                    </h4>
                    
                    <div class="row g-4">
                      <div class="col-md-6">
                        <label class="form-label">Upload Photo</label>
                        <div class="upload-area" id="uploadPhotoArea">
                          <div class="upload-icon">
                            <i class="bi bi-camera"></i>
                          </div>
                          <p class="upload-text">Click to upload photo</p>
                          <p class="upload-subtext">PNG, JPG or JPEG (Max 2MB)</p>
                          <input type="file" id="uploadPhoto" name="photo" class="d-none" accept="image/*">
                        </div>
                      </div>
                      
                      <div class="col-md-6">
                        <label class="form-label">ID Card / Passport</label>
                        <div class="upload-area" id="uploadIDArea">
                          <div class="upload-icon">
                            <i class="bi bi-credit-card"></i>
                          </div>
                          <p class="upload-text">Click to upload ID</p>
                          <p class="upload-subtext">PNG, JPG or PDF (Max 2MB)</p>
                          <input type="file" id="uploadID" name="id_card_photo" class="d-none" accept="image/*,.pdf">
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  <!-- Submit Button -->
                  <div class="btn-submit-container text-center" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="600">
                    <button type="submit" class="btn btn-submit px-5">
                      <i class="bi bi-check-circle"></i>
                      Submit Registration
                    </button>
                    <div class="success-checkmark mt-4" id="successCheckmark">
                      <div class="check-icon"></div>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </main>
  
  <!-- Footer -->
  <footer class="footer">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
          <div class="d-flex flex-column flex-md-row justify-content-between align-items-center">
            <div class="d-flex align-items-center g-2 mb-4 mb-md-0">
              <div class="footer-logo " style="margin-left: 10px;">
               <img src="https://new.ncomp.site/public/assets/img/logo1.png" width="80px" alt="">
              </div>
              <div>
                <h3 class="footer-title">The Garden of Quran</h3>
                <p class="footer-subtitle">Excellence in Education</p>
              </div>
            </div>
            <p class="footer-copyright">Copyright © 2025. All rights reserved.</p>
          </div>
        </div>
      </div>
    </div>
  </footer>

  <!-- Bootstrap JS Bundle with Popper -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- AOS Animation Library -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  
  <!-- Custom JavaScript -->
  <script>
    document.addEventListener('DOMContentLoaded', function() {
      // Initialize AOS animations
      AOS.init({
        once: true,
        duration: 800,
        easing: 'ease-in-out',
        disable: window.innerWidth < 768 ? true : false // Disable on mobile for better performance
      });
      
      // Create particles
      createDynamicParticles();
      
      // Hide loading overlay after page loads
      setTimeout(function() {
        document.getElementById('loadingOverlay').style.opacity = '0';
        setTimeout(function() {
          document.getElementById('loadingOverlay').style.display = 'none';
        }, 500);
      }, 1500);
      
      // File upload handling
      const uploadPhotoArea = document.getElementById('uploadPhotoArea');
      const uploadPhoto = document.getElementById('uploadPhoto');
      const uploadIDArea = document.getElementById('uploadIDArea');
      const uploadID = document.getElementById('uploadID');
      
      uploadPhotoArea.addEventListener('click', function() {
        uploadPhoto.click();
      });
      
      uploadIDArea.addEventListener('click', function() {
        uploadID.click();
      });
      
      // Display file name after selection
      uploadPhoto.addEventListener('change', function() {
        if (this.files.length > 0) {
          const fileName = this.files[0].name;
          const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
          
          if (fileSize > 2) {
            alert('File size exceeds 2MB limit. Please choose a smaller file.');
            this.value = '';
            return;
          }
          
          const uploadIcon = uploadPhotoArea.querySelector('.upload-icon');
          uploadIcon.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
          
          const paragraph = uploadPhotoArea.querySelector('.upload-text');
          paragraph.textContent = fileName;
          
          // Update progress bar
          updateProgress();
        }
      });
      
      uploadID.addEventListener('change', function() {
        if (this.files.length > 0) {
          const fileName = this.files[0].name;
          const fileSize = (this.files[0].size / 1024 / 1024).toFixed(2);
          
          if (fileSize > 2) {
            alert('File size exceeds 2MB limit. Please choose a smaller file.');
            this.value = '';
            return;
          }
          
          const uploadIcon = uploadIDArea.querySelector('.upload-icon');
          uploadIcon.innerHTML = '<i class="bi bi-check-circle-fill"></i>';
          
          const paragraph = uploadIDArea.querySelector('.upload-text');
          paragraph.textContent = fileName;
          
          // Update progress bar
          updateProgress();
        }
      });
      
      // Form input event listeners for progress bar
      const formInputs = document.querySelectorAll('#competitionForm input, #competitionForm select');
      formInputs.forEach(input => {
        input.addEventListener('change', updateProgress);
        input.addEventListener('input', updateProgress);
      });
      
      // Calculate age from date of birth
      const dobInput = document.getElementById('dob');
      const ageInput = document.getElementById('age');
      
      dobInput.addEventListener('change', function() {
        if (this.value) {
          const dob = new Date(this.value);
          const today = new Date();
          let age = today.getFullYear() - dob.getFullYear();
          const monthDiff = today.getMonth() - dob.getMonth();
          
          if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < dob.getDate())) {
            age--;
          }
          
          ageInput.value = age;
          
          // Update progress bar
          updateProgress();
        }
      });
      
      // Form submission
      const form = document.getElementById('competitionForm');
      const successCheckmark = document.getElementById('successCheckmark');
      

      
      
      // Update progress bar based on form completion
      function updateProgress() {
        const formInputs = document.querySelectorAll('#competitionForm input:not([type="file"]), #competitionForm select');
        let filledInputs = 0;
        
        formInputs.forEach(input => {
          if (input.value) {
            filledInputs++;
          }
        });
        
        // Check file inputs
        if (document.getElementById('uploadPhoto').files.length > 0) {
          filledInputs++;
        }
        
        if (document.getElementById('uploadID').files.length > 0) {
          filledInputs++;
        }
        
        const progressPercentage = (filledInputs / (formInputs.length + 2)) * 100;
        document.getElementById('formProgress').style.width = progressPercentage + '%';
      }
      
      // Parallax effect for background - optimized for mobile
      function initParallax() {
        // Only enable parallax on devices that likely have enough processing power
        if (window.innerWidth >= 992) {
          document.addEventListener('mousemove', function(e) {
            const layers = document.querySelectorAll('.parallax-layer');
            const pageX = e.clientX - window.innerWidth / 2;
            const pageY = e.clientY - window.innerHeight / 2;
            
            layers.forEach(function(layer, index) {
              const depth = (index + 1) * 0.01;
              const moveX = pageX * depth;
              const moveY = pageY * depth;
              layer.style.transform = `translate(${moveX}px, ${moveY}px) scale(${1 + depth})`;
            });
          });
        }
      }

      // Initialize parallax effect
      initParallax();

      // Create more dynamic particles - optimized for different screen sizes
      function createDynamicParticles() {
        const particlesContainer = document.getElementById('particles');
        particlesContainer.innerHTML = ''; // Clear existing particles
        
        // Adjust particle count based on screen size
        let particleCount = 50;
        if (window.innerWidth < 768) {
          particleCount = 20;
        } else if (window.innerWidth < 1200) {
          particleCount = 30;
        }
        
        const particleTypes = ['circle', 'square', 'triangle'];
        
        for (let i = 0; i < particleCount; i++) {
          const particle = document.createElement('div');
          particle.classList.add('particle');
          
          // Random properties
          const size = Math.random() * 15 + 5;
          const posX = Math.random() * 100;
          const delay = Math.random() * 10;
          const duration = Math.random() * 15 + 15;
          const color = getRandomColor(0.6);
          const type = particleTypes[Math.floor(Math.random() * particleTypes.length)];
          
          // Apply styles
          particle.style.width = size + 'px';
          particle.style.height = size + 'px';
          particle.style.left = posX + 'vw';
          particle.style.bottom = '-50px';
          particle.style.backgroundColor = color;
          particle.style.animationDuration = duration + 's';
          particle.style.animationDelay = delay + 's';
          
          // Apply different shapes
          if (type === 'square') {
            particle.style.borderRadius = '20%';
          } else if (type === 'triangle') {
            particle.style.width = '0';
            particle.style.height = '0';
            particle.style.backgroundColor = 'transparent';
            particle.style.borderLeft = (size/2) + 'px solid transparent';
            particle.style.borderRight = (size/2) + 'px solid transparent';
            particle.style.borderBottom = size + 'px solid ' + color;
          }
          
          particlesContainer.appendChild(particle);
        }
      }

      // Get random color with opacity
      function getRandomColor(opacity = 0.7) {
        const hue = Math.floor(Math.random() * 360);
        return `hsla(${hue}, 80%, 60%, ${opacity})`;
      }
      
      // Handle window resize for responsive adjustments
      let resizeTimer;
      window.addEventListener('resize', function() {
        clearTimeout(resizeTimer);
        resizeTimer = setTimeout(function() {
          // Recreate particles with appropriate count for new screen size
          createDynamicParticles();
          
          // Reinitialize AOS for new screen size
          AOS.refresh();
        }, 250);
      });
    });
  </script>
</body>
</html>


