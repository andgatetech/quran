<!DOCTYPE html>
<html lang="en">
<head>
  <link rel="stylesheet" href="{{ asset('public/assets/css/color.css') }}">

  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Competition List</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

  <link rel="stylesheet" href="css/CompetitionList.css">
  <style>


.btn {
      font-size: .9rem !important;
      border-radius: .3rem !important;
      padding: .4rem 0 !important;
      border: 1px solid var(--secondary-color) !important;
      background-color: var(--secondary-color) !important;
      color: var(--primary-color) !important;
      cursor: pointer !important;
      text-align: center !important;
      margin: 5px !important;
    }
       .btn:hover {

        border: 1px solid var(--secondary-color) !important;
      background-color: var(--primary-color) !important;
      color: var(--secondary-color) !important;

    }


    .competition-list {

      border-radius: 10px;
    }

    .list-heading {
      background-color: var(--secondary-color);
      color: var(--primary-color);
      padding: 10px;
      text-align: center;
      border-radius: 10px;
      font-size: 14px;
    }

    .competitions-container {
      margin-top: 20px;
      max-height: 60rem;
      min-height: 10rem;
      overflow-y: auto; /* Enable vertical scrollbar when content overflows */
    }

    /* Competition Cards */
    .competition-card {
      background: white;
      margin: 10px 0;
      border: 1px solid #ddd;
      border-radius: 10px;
      padding: 10px 20px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
    }

    .competition-main-name p,
    .competition-sub-name p {
      font-size: 16px;
      margin-bottom: 5px;
      text-align: left;
      cursor: pointer; /* Add cursor pointer to indicate it is clickable */
    }
    .competition-sub-name .pdf-section, .button-section {  
      display: inline;
      width: 50%;
    }
    .competition-sub-name .button-section button{  
      display: inline;
      width: 150px;
    }


    .competition-main-name span,
    .competition-sub-name span {
      color: var(--secondary-color);
      float: right;
    }
    .competition-sub-name span a {
      color: var(--secondary-color);
      float: right;
      text-decoration: none;
    }

    .competition-main-name i {
      float: right;
      color: #888;
    }
    p{
        font-size: 16px;
    }
    .heading{
        background: #016da8;
        border-radius: 15px;
        color: white;
    }

    .delete-btn, .edit-btn {
        padding: 10px 50px !important;
        border-radius: 15px !important;
    }
    @media (max-width: 435px) {
        .competition-main-name p,
    .competition-sub-name p {
            font-size: 13px;
        }
    }




  </style>
</head>
<body>

  <header class="header">
    <a class="back-btn" href="{{ route('client.menu.quran') }}"><i class="fas fa-home"></i></a>
    <h1>How to Manage Competition</h1>
  </header>

  <div class="container1">
    <div class="tabs">
    <button class="tab-btn" onclick="window.location.href='{{ route('managecompitition.mageyPlan') }}'">Magey Plan</button>
      <button class="tab-btn" onclick="window.location.href='{{ route('managecompitition.howManage') }}'">How to Manage</button>
      <button class="tab-btn active" onclick="window.location.href='{{ route('managecompitition.bulkUpload') }}'">Bulk Upload Drafts</button>
      <button class="tab-btn" onclick="window.location.href='{{ route('managecompitition.buyAddOns') }}'">Buy Addons</button>
    </div>
  </div>

  <div class="container">
    <div class="row mb-4">
        <div class="col-md-6 col-sm-12 offset-md-3">
            
                <div class="competition-card">
                <h6 class="heading col-12 py-3 my-3">Bulk Question</h6>
                    <div class="competition-sub-name">
                    <div class="pdf-section"><img src="{{url('public/assets/img/xls.png')}}" alt="Pdf" width="80px"/></div> 
                    <div class="button-section"><button class="btn btn-primary">View</button>
                    <button class="btn btn-primary">Download</button></div>
                    </div>      
                </div>

                <div class="competition-card">
                <h6 class="heading col-12 py-3 my-3">Bulk Participant</h6>
                    <div class="competition-sub-name">
                    <div class="pdf-section"><img src="{{url('public/assets/img/xls.png')}}" alt="Pdf" width="80px"/></div> 
                    <div class="button-section"><button class="btn btn-primary">View</button>
                    <button class="btn btn-primary">Download</button></div>
                    </div>      
                </div>
        </div>
    </div>
</div>

  @include('includes.footer')


</body>
</html>
