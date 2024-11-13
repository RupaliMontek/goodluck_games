<?php

namespace App\Models;

use CodeIgniter\Model;

class ScoreModel extends Model
{
    protected $table = 'scores'; // The name of the database table
    protected $primaryKey = 'id'; // The primary key field

    // Allowed fields for mass assignment (ensure you have the right fields)
    protected $allowedFields = [
        'player_id',
        'showNobtn0',
        'showNobtn1',
        'showNobtn2',
        'showNobtn3',
        'showNobtn4',
        'showNobtn5',
        'showNobtn6',
        'showNobtn7',
        'showNobtn8',
        'showNobtn9',
        'total',
        'win_before_after_score',
        'win_before_score',
        'winner_number',
        'winner_amount',
        'loss_amount',
        'created_at'
    ];
    protected $createdField = 'created_at';
    
    public function calculateSums($players)
    {
        $sums = array_fill(0, 10, 0); 
        foreach ($players as $player) 
        {
            for ($i = 0; $i < 10; $i++)
            {  
                $button ="button_".$i."_value";
                $sums[$i] += $player[$button];
            }
        }
        return $sums;
    }
    
    public function calculateSums_ajax($players)
    {
        $sums = array_fill(0, 10, 0); 
        foreach ($players as $player) 
        {
            for ($i = 0; $i < 10; $i++)
            {  
                $button ="button_".$i."_value";
                $sums[$i] += $player[$button];
            }
        }
        return $sums;
    }
    
    public function get_last_entries_within_minute() {
    $one_minute_ago = date('Y-m-d H:i:s', strtotime('-1 minute'));

    return $this->db->table('scores')
                    ->select('*')
                    ->where('created_at >=', $one_minute_ago)
                    ->orderBy('created_at', 'DESC')
                    ->get()
                    ->getResultArray();
}
public function get_latest_entry_for_each_user() 
{
$one_second_ago = date('Y-m-d h:i:s A', strtotime('-50 seconds')); // 12-hour format with AM/PM

$subQuery = "SELECT s2.* 
             FROM playing_number_player AS s2 
             WHERE s2.play_id = 
                 (SELECT MAX(s3.play_id) 
                  FROM playing_number_player AS s3 
                  WHERE s3.player_id = s2.player_id 
                  AND DATE_FORMAT(s3.created_at, '%Y-%m-%d %r') >= '$one_second_ago' 
                  ORDER BY s3.created_at DESC 
                  LIMIT 1)";

$query = "SELECT s.* 
          FROM playing_number_player AS s 
          INNER JOIN ($subQuery) AS latest 
          ON s.play_id = latest.play_id";

/*echo $query;

exit;*/
return $this->db->query($query)->getResultArray();


}


public function getPlayerScores($limit, $offset, $today)
{
    $results = $this->select('scores.*, sa.first_name, sa.last_name AS player_name, scores.created_at')
                    ->join('super_admins sa', 'sa.id = scores.player_id') // Assuming 'player_id' in 'scores' table references 'id' in 'super_admins' table
                    ->where('created_at >=', $today)
                    ->orderBy('scores.created_at', 'DESC')
                    ->limit($limit, $offset)
                    ->findAll();

    $results = array_reverse($results);

    return $results;
}
// public function getPreviousBet()
//     {
//         return $this->where('player_id', session()->get('player_id'))->orderBy('created_at', 'DESC')->first();
//     }
public function getPreviousBet($user_id)
{
    return $this->where('total >', 0)
                ->where('player_id', $user_id)
                ->groupStart()
                    ->where('showNobtn0 !=', '')
                    ->orWhere('showNobtn1 !=', '')
                    ->orWhere('showNobtn2 !=', '')
                    ->orWhere('showNobtn3 !=', '')
                    ->orWhere('showNobtn4 !=', '')
                    ->orWhere('showNobtn5 !=', '')
                    ->orWhere('showNobtn6 !=', '')
                    ->orWhere('showNobtn7 !=', '')
                    ->orWhere('showNobtn8 !=', '')
                    ->orWhere('showNobtn9 !=', '')
                ->groupEnd()
                ->orderBy('created_at', 'DESC')
                ->first();
}


 public function get_all_player_details()
    {
        $today = date('Y-m-d'); // Get today's date
        return $this->select('scores.*, sa.first_name, sa.last_name')
            ->orderBy('scores.created_at', 'DESC')
            ->join('super_admins sa', 'sa.id = scores.player_id')
            ->where('DATE(scores.created_at)', $today)
            ->findAll();
    }    

public function get_all_player_game_detailss()
{
    return $this->select('scores.*, sa.*, scores.created_at')
                ->join('super_admins sa', 'sa.id = scores.player_id')
                ->groupBy('sa.id')
                ->findAll();
}
public function get_today_players($players_per_page)
{
    $today = date('Y-m-d'); // Get today's date
    return $this->select('*')
        ->where('DATE(created_at)', $today)
        ->orderBy('created_at', 'DESC')
        ->paginate($players_per_page);
}

//     public function get_all_player_details()
//   {
//         $today = date('Y-m-d');
//         return $this->select('*')
//         ->orderBy('scores.created_at', 'DESC')
//         ->join('super_admins sa', 'sa.id = scores.player_id')
//         ->where('DATE(scores.created_at)', $today)
//         ->findAll();
//   }
   public function get_scores_in_last_24_hours($player_id, $last_24_hours, $perPage, $offset) {
        // Example query using Query Builder
        return $this->select('*')
                    ->where('player_id', $player_id)
                    ->where('created_at >=', $last_24_hours)
                    ->orderBy('created_at', 'desc')
                    ->paginate($perPage, 'default', $offset);
    }
 public function get_all_scores_details_by_player($player_id, $last_24_hours = null, $limit = null, $offset = null)
{
    $builder = $this->db->table('scores')
                        ->select('scores.player_id, sa.*, scores.created_at as createdat,scores.winner_amount as total_winner_amount, scores.loss_amount as total_loss_amount')
                        ->join('super_admins sa', 'sa.id = scores.player_id')
                        ->where('scores.player_id', $player_id);

    if ($last_24_hours !== null) {
        $builder->where('scores.created_at >=', date('Y-m-d', strtotime('-1 day')));

    }

    if ($limit !== null && $offset !== null) {
        $builder->limit($limit, $offset);
    }

    $query = $builder->orderBy('scores.created_at', 'desc')
                     ->get();
 // Print the last executed query
 //   echo $this->db->getLastQuery();exit;
    return $query->getResultArray();
}


public function get_all_player_game_details($limit = null, $offset = null)
{
    $builder = $this->select('*, scores.created_at')
                    ->join('super_admins sa', 'sa.id = scores.player_id')
                    ->where('sa.role', 'user')
                    ->groupBy('sa.id');

    if ($limit !== null && $offset !== null) {
        $builder->limit($limit, $offset);
    }

    return $builder->findAll();
}

   public function get_all_player_game_details_by_player($player_id)
   {
  $builder = $this->select('scores.player_id, SUM(scores.winner_amount) as total_winner_amount, SUM(scores.loss_amount) as total_loss_amount')
                ->join('super_admins sa', 'sa.id = scores.player_id')
                ->where('scores.player_id', $player_id)
                ->groupBy('scores.player_id')
                ->get();

    return $builder->getRowArray();
   }
     
// public function get_all_scores_details_by_player($player_id, $limit = null, $offset = null)
// {
//     $builder = $this->db->table('scores')
//                         ->select('scores.player_id, sa.*, scores.winner_amount as total_winner_amount, scores.loss_amount as total_loss_amount')
//                         ->join('super_admins sa', 'sa.id = scores.player_id')
//                         ->where('scores.player_id', $player_id);

//     if ($limit !== null && $offset !== null) {
//         $builder->limit($limit, $offset);
//     }

//     $query = $builder->get();
//     return $query->getResultArray();
// }

 
public function get_all_scores_details_by_playerss($player_id, $limit, $offset)
{
    // Get today's date in Y-m-d format
    $todayDate = date("Y-m-d");
    // Build the query
    $builder = $this->db->table('scores')
    ->orderBy('scores.id', 'desc')
    ->select('scores.player_id, sa.*, scores.winner_amount as total_winner_amount, scores.loss_amount as total_loss_amount')
    ->join('super_admins sa', 'sa.id = scores.player_id')
    ->where('scores.player_id', $player_id)
    ->where("DATE(scores.created_at)", $todayDate) // Compare date part only
    ->limit($limit, $offset);
    $query = $builder->get();
    // Return the result as an array
    return $query->getResultArray();
}

    public function count_all_scores_by_player($player_id)
    {
        return $this->db->table('scores')
            ->where('player_id', $player_id)
            ->countAllResults();
    }  
}
