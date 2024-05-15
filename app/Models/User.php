<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use App\Enums\UserTypeEnum;
use Laravel\Sanctum\HasApiTokens;
use Filament\Forms\Components\TextInput;
use Illuminate\Notifications\Notifiable;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Section;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'user_type',
    ];

    protected $casts = 
    [
        'user_type' => UserTypeEnum::class,
    ];
    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
      
        ];
    }

    public static function getForm()
    {
        return [
            Section::make()->columns(2)->schema([
                TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                TextInput::make('username')
                    ->required()
                    ->unique()
                    ->maxLength(255),
                TextInput::make('email')
                    ->email()
                    ->required()
                    ->maxLength(255),
                DateTimePicker::make('email_verified_at')
                    ->readOnly(),
                TextInput::make('password')
                    ->password()
                    ->required()
                    ->maxLength(255),
                TextInput::make('user_type'),
            ])
            
        ];
    }
    public function accounts(): HasMany
    {
        return $this->hasMany(Account::class);
    }

    public function userDetails(): HasOne
    {
        return $this->hasOne(UserDetails::class);
    }
}
