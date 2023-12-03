<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Mlb extends Model
{
    use HasFactory;
    public $timestamps = "true";
    protected $table = "mlb_elo as mlb";
    protected $fillable =
    [
        'dates',
        'season',
        'neutral',
        'playoff',
        'team1',
        'team2',
        'elo1_pre',
        'elo2_pre',
        'elo_prob1',
        'elo_prob2',
        'elo1_post',
        'elo2_post',
        'rating1_pre',
        'rating2_pre',
        'pitcher1',
        'pitcher2',
        'pitcher1_rgs',
        'pitcher2_rgs',
        'pitcher1_adj',
        'pitcher2_adj',
        'rating_prob1',
        'rating_prob2',
        'rating1_post',
        'rating2_post',
        'score1',
        'score2',
    ];

}
