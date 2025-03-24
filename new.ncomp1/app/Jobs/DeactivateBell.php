<?php
// namespace App\Jobs;

// use App\Models\BellNotification;
// use Illuminate\Bus\Queueable;
// use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
// use Illuminate\Queue\InteractsWithQueue;
// use Illuminate\Queue\SerializesModels;

// class DeactivateBell implements ShouldQueue
// {
//     use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

//     protected $competitorId;
//     protected $competitionId;

//     public function __construct($competitorId, $competitionId)
//     {
//         $this->competitorId = $competitorId;
//         $this->competitionId = $competitionId;
//     }

//     public function handle()
//     {
//         BellNotification::where('competitor_id', $this->competitorId)
//             ->where('competition_id', $this->competitionId)
//             ->update(['is_active' => false]);
//     }
// } -->
