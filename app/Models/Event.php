<?php

namespace App\Models;

use App\Models\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Models\Event
 *
 * @property int $id
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_solved
 * @property string $description
 * @property int $country_id
 * @property int $author_id
 * @property int $type_id
 * @property string $region
 * @property string $locality
 * @property float $lat
 * @property float $long
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereAuthorId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCountryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereIsSolved($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLat($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLocality($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereLong($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereRegion($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Models\Event whereUpdatedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Models\Event withoutTrashed()
 * @mixin \Eloquent
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\User[] $participants
 * @property-read int|null $participants_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Picture[] $pictures
 * @property-read int|null $pictures_count
 */
class Event extends Model
{
    use SoftDeletes;
    //@ToDo: добавить в миграцию флаг активности события и других сущностей

    protected $fillable = [
        'id',
        'is_solved',
        'description',
        'country_id',
        'author_id',
        'type_id',
        'region',
        'locality',
        'lat',
        'long',
    ];

    public function participants() {
        return $this->belongsToMany(User::class)
            ->withTimestamps()
            ->withPivot('is_successful');
    }

    public function getShortDescription() {
        return mb_strimwidth($this->description, 0, 50, '...');
    }

    public function getHowLongWasCreated() {
        return $this->created_at; // @ToDo: реализовать формат вида "час назад / день назад" итд
    }

    public function getTypeName() {
        return $this->belongsTo(
            EventType::class,
            'type_id'
        )->first()->name;
    }

    public function getTypePicture(int $width = 32, int $height = 32) {
        $typeName = $this->belongsTo(
            EventType::class,
            'type_id'
        )->first()->name;

        $typeNameToPictureMap = [
            'towing_required' => '<svg height="' . $height . '" viewBox="0 0 64 64" width="' . $width . '" xmlns="http://www.w3.org/2000/svg"><g id="Tow_Truck" data-name="Tow Truck"><path d="m19.63 27h-2.63v4h7.297z"/><circle cx="8" cy="38" r="1"/><circle cx="26" cy="38" r="1"/><path d="m4 37h1.184a2.982 2.982 0 0 1 5.632 0h12.368a2.982 2.982 0 0 1 5.632 0h1.184v-2.587l-1.406-1.413h-24.594z"/><path d="m15 27h-3.764a.994.994 0 0 0 -.894.553l-1.724 3.447h6.382z"/><path d="m56 40h4v2h-4z"/><path d="m44 25v9h15.267l-4.58-8.475a1 1 0 0 0 -.88-.525z"/><path d="m59 50a1 1 0 0 0 1-1v-1h-3v-2h3v-2h-4a2 2 0 0 1 -2-2v-2a2 2 0 0 1 2-2h4v-1.892c0-.037-.013-.072-.015-.108h-16.985a1 1 0 0 1 -1-1v-10h-2v25h3.09a5.993 5.993 0 0 1 11.82 0zm-13-10h-4v-2h4z"/><path d="m49 47a4 4 0 1 0 4 4 4 4 0 0 0 -4-4zm1 5h-2v-2h2z"/><path d="m38 50v-7h-34v7h2.09a5.993 5.993 0 0 1 11.82 0z"/><path d="m38 24.218-29.456-13.729-.845 1.817 30.301 14.125z"/><path d="m38 28.637-2-.932v13.295h2z"/><path d="m12 47a4 4 0 1 0 4 4 4 4 0 0 0 -4-4zm1 5h-2v-2h2z"/><path d="m7 24a3 3 0 0 1 -3-3h2a1 1 0 1 0 1-1 1 1 0 0 1 -1-1v-4.917h2v4.088a3 3 0 0 1 -1 5.829z"/></g></svg>',
            'need_to_push' => "<svg xmlns='http://www.w3.org/2000/svg' width='" . $width . "' height='" . $height . "' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Layer_1' x='0px' y='0px' viewBox='0 0 512 512' style='enable-background:new 0 0 512 512;' xml:space='preserve'><g><g><path d='M214.498,306.18c-20.751,0-37.574,16.823-37.574,37.574s16.823,37.574,37.574,37.574    c20.751,0,37.574-16.823,37.574-37.574C252.072,323.001,235.249,306.18,214.498,306.18z M214.498,358.973    c-8.406,0-15.219-6.814-15.219-15.219c0-8.406,6.814-15.219,15.219-15.219c8.406,0,15.219,6.815,15.219,15.219    C229.717,352.158,222.903,358.973,214.498,358.973z'/></g></g><g><g><path d='M424.202,306.18c-20.751,0-37.574,16.823-37.574,37.574s16.822,37.574,37.574,37.574    c20.752,0,37.574-16.823,37.574-37.574C461.775,323.001,444.953,306.18,424.202,306.18z M424.202,358.973    c-8.406,0-15.219-6.814-15.219-15.219c0-8.406,6.814-15.219,15.219-15.219c8.406,0,15.219,6.815,15.219,15.219    C439.421,352.158,432.608,358.973,424.202,358.973z'/></g></g><g><g><path d='M75.268,325.64l-24.827-28.752l-0.055,19.668L4.041,359.877c-5.14,4.804-5.413,12.865-0.608,18.005    c4.806,5.142,12.869,5.409,18.005,0.608l50.372-47.082c1.66-1.552,2.849-3.504,3.491-5.64L75.268,325.64z'/></g></g><g><g><path d='M154.601,170.965c-8.943-8.237-22.861-7.653-31.088,1.279c-8.231,8.938-7.659,22.857,1.279,31.088    c8.938,8.232,22.858,7.659,31.089-1.279C164.113,193.115,163.54,179.196,154.601,170.965z'/></g></g><g><g><path d='M154.853,266.69l-33.974-13.934l-5.77-28.865l14.782,15.242l0.37-0.401c5.052-5.485,5.533-11.732,3.198-16.873    c-1.638-3.606-1.729-3.18-22.961-22.733c-5.137-4.73-12.997-5.282-18.75-1.135c-0.175,0.126-1.07,1.041-2.513,2.558    C59.249,232.057,58.144,281,86.578,313.914l3.493,4.044l13.588,54.283c1.625,6.847,8.487,11.077,15.334,9.456    c6.846-1.623,11.079-8.489,9.456-15.334l-14.306-57.313c-0.472-1.991-1.416-3.838-2.753-5.386l-34.889-40.406l11.75,6.817    c-1.129-2.553-2.047-5.703-1.9-8.62c0,0,4.467-50.995,4.507-51.236c0.057,1.167,3.672,20.396,9.537,51.942    c0.702,3.501,3.106,6.397,6.382,7.741l40.019,16.432c4.973,2.041,10.494-0.002,13.102-4.31c0.016-0.026,0.028-0.052,0.043-0.077    C163.298,276.302,160.791,269.124,154.853,266.69z'/></g></g><g><g><path d='M495.577,295.893c0-3.807,0-7.722,0-11.653h-17.861c-8.803,0-15.94-7.136-15.94-15.94c0-8.803,7.136-15.94,15.94-15.94    h15.401c-5.797-16.11-21.206-27.634-39.311-27.634h-56.498l-46.972-83.88c-3.763-6.717-10.883-10.89-18.581-10.89H179.839    c-9.921,0-18.669,7.033-20.8,16.722l-1.47,6.682c9.441,5.001,16.298,13.617,19.036,23.91l5.189-23.585h52.382v71.185h-68.043    l2.91-13.227c-6.999,8.379-17.029,13.12-27.305,13.675l-4.196,19.071l22.648,9.289c12.618,5.174,18.645,19.575,13.467,32.196    c-5.272,12.858-19.804,18.553-32.2,13.466c-9.76-4.008-5.692-2.337-19.15-7.862c1.603,1.856,5.796,6.238,7.6,13.722l9.576,38.364    c2.04,0.249,1.517,0.189,17.973,0.189c0-31.454,25.589-57.044,57.044-57.044c31.454,0,57.044,25.589,57.044,57.044h95.617    c0-31.454,25.589-57.044,57.044-57.044c31.454,0,57.044,25.589,57.044,57.044h6.12c13.605,0,24.634-11.029,24.634-24.634    C512,308.394,505.144,299.275,495.577,295.893z M304.983,267.171h-25.427c-5.377,0-9.734-4.358-9.734-9.734    c0-5.377,4.358-9.734,9.734-9.734h25.427c5.377,0,9.735,4.358,9.735,9.734C314.719,262.813,310.36,267.171,304.983,267.171z     M340.629,224.871l11.049-13.789c2.803-3.496,2.238-8.602-1.257-11.403c-3.496-2.802-8.603-2.239-11.403,1.257l-19.18,23.934    h-17.001v-9.288c0-9.768-7.918-17.686-17.686-17.686c-9.768,0-17.686,7.918-17.686,17.686v9.288h-8.025v-71.184h17.971    c-7.006,3.005-11.916,9.961-11.916,18.068c0,10.856,8.8,19.654,19.656,19.654c10.856,0,19.656-8.8,19.656-19.654    c0-8.106-4.909-15.062-11.916-18.068h37.437l39.783,71.041L340.629,224.871z'/></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>",
            'need_tool' => "<svg xmlns='http://www.w3.org/2000/svg' width='" . $width . "' height='" . $height . "' xmlns:xlink='http://www.w3.org/1999/xlink' version='1.1' id='Capa_1' x='0px' y='0px' viewBox='0 0 231.233 231.233' style='enable-background:new 0 0 231.233 231.233;' xml:space='preserve'><path d='M230.505,102.78c-0.365-3.25-4.156-5.695-7.434-5.695c-10.594,0-19.996-6.218-23.939-15.842  c-4.025-9.855-1.428-21.346,6.465-28.587c2.486-2.273,2.789-6.079,0.705-8.721c-5.424-6.886-11.586-13.107-18.316-18.498  c-2.633-2.112-6.502-1.818-8.787,0.711c-6.891,7.632-19.27,10.468-28.836,6.477c-9.951-4.187-16.232-14.274-15.615-25.101  c0.203-3.403-2.285-6.36-5.676-6.755c-8.637-1-17.35-1.029-26.012-0.068c-3.348,0.37-5.834,3.257-5.723,6.617  c0.375,10.721-5.977,20.63-15.832,24.667c-9.451,3.861-21.744,1.046-28.621-6.519c-2.273-2.492-6.074-2.798-8.725-0.731  c-6.928,5.437-13.229,11.662-18.703,18.492c-2.133,2.655-1.818,6.503,0.689,8.784c8.049,7.289,10.644,18.879,6.465,28.849  c-3.99,9.505-13.859,15.628-25.156,15.628c-3.666-0.118-6.275,2.345-6.68,5.679c-1.016,8.683-1.027,17.535-0.049,26.289  c0.365,3.264,4.268,5.688,7.582,5.688c10.07-0.256,19.732,5.974,23.791,15.841c4.039,9.855,1.439,21.341-6.467,28.592  c-2.473,2.273-2.789,6.07-0.701,8.709c5.369,6.843,11.537,13.068,18.287,18.505c2.65,2.134,6.504,1.835,8.801-0.697  c6.918-7.65,19.295-10.481,28.822-6.482c9.98,4.176,16.258,14.262,15.645,25.092c-0.201,3.403,2.293,6.369,5.672,6.755  c4.42,0.517,8.863,0.773,13.32,0.773c4.23,0,8.461-0.231,12.692-0.702c3.352-0.37,5.834-3.26,5.721-6.621  c-0.387-10.716,5.979-20.626,15.822-24.655c9.514-3.886,21.752-1.042,28.633,6.512c2.285,2.487,6.063,2.789,8.725,0.73  c6.916-5.423,13.205-11.645,18.703-18.493c2.135-2.65,1.832-6.503-0.689-8.788c-8.047-7.284-10.656-18.879-6.477-28.839  c3.928-9.377,13.43-15.673,23.65-15.673l1.43,0.038c3.318,0.269,6.367-2.286,6.768-5.671  C231.476,120.379,231.487,111.537,230.505,102.78z M115.616,182.27c-36.813,0-66.654-29.841-66.654-66.653  s29.842-66.653,66.654-66.653s66.654,29.841,66.654,66.653c0,12.495-3.445,24.182-9.428,34.176l-29.186-29.187  c2.113-4.982,3.229-10.383,3.228-15.957c0-10.915-4.251-21.176-11.97-28.893c-7.717-7.717-17.978-11.967-28.891-11.967  c-3.642,0-7.267,0.484-10.774,1.439c-1.536,0.419-2.792,1.685-3.201,3.224c-0.418,1.574,0.053,3.187,1.283,4.418  c0,0,14.409,14.52,19.23,19.34c0.505,0.505,0.504,1.71,0.433,2.144l-0.045,0.317c-0.486,5.3-1.423,11.662-2.196,14.107  c-0.104,0.103-0.202,0.19-0.308,0.296c-0.111,0.111-0.213,0.218-0.32,0.328c-2.477,0.795-8.937,1.743-14.321,2.225l0.001-0.029  l-0.242,0.061c-0.043,0.005-0.123,0.011-0.229,0.011c-0.582,0-1.438-0.163-2.216-0.94c-5.018-5.018-18.862-18.763-18.862-18.763  c-1.242-1.238-2.516-1.498-3.365-1.498c-1.979,0-3.751,1.43-4.309,3.481c-3.811,14.103,0.229,29.273,10.546,39.591  c7.719,7.718,17.981,11.968,28.896,11.968c5.574,0,10.975-1.115,15.956-3.228l29.503,29.503  C141.125,178.412,128.825,182.27,115.616,182.27z'/><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>",
            'need_fuel' => "<svg version='1.1' width='" . $width . "' height='" . $height . "' id='Capa_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' viewBox='0 0 179.006 179.006' style='enable-background:new 0 0 179.006 179.006;' xml:space='preserve'><g><path style='fill:#010002;' d='M69.246,97.982c-3.258,0-5.901-2.637-5.901-5.907c0-3.27,5.901-13.61,5.901-13.61 s5.901,10.347,5.901,13.61C75.147,95.339,72.509,97.982,69.246,97.982z M64.8,73.894h-6.766v36.076H46.297v5.549h6.826v5.102H0 v-5.102h6.832V58.392h39.471v46.47h6.623V71.346l0.03-2.56h2.512H67.3l3.962,5.09l-4.028,3.139L64.8,73.894z M37.55,67.235H15.574 v16.403H37.55V67.235z M110.333,78.852c0.668,0.871,1.283,1.82,1.784,2.846c0.495,1.032,0.859,2.094,1.122,3.168l36.464-21.32 L110.333,78.852z M93.244,78.966c-5.812,3.031-8.073,10.209-5.036,16.027c3.037,5.818,10.215,8.079,16.021,5.048 c5.824-3.037,8.085-10.203,5.054-16.033C106.252,78.19,99.074,75.934,93.244,78.966z M104.862,15.938h-9.314v24.464h9.314V15.938z M95.553,163.069h9.314v-24.47h-9.314V163.069z M154.542,84.843v9.32h24.464v-9.32H154.542z M130.931,47.407l3.294,3.294 l17.298-17.298l-3.3-3.294L130.931,47.407z M130.931,131.599l17.298,17.298l3.294-3.294l-17.292-17.298L130.931,131.599z M74.043,152.346H86v-2.112v-2.1H74.043v-5.197h12.894v-2.172v-2.16H68.929v24.464h18.575v-2.178v-2.172H74.043V152.346z M74.61,40.402V30.055h10.716v-2.112v-2.094H74.61v-5.567h12.304v-2.178v-2.166H69.508v24.464h2.56H74.61z'/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>",
            'charge_battery' => '<svg version="1.1" id="Layer_1" height="' . $height . '" width="' . $width . '" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><g><path d="M486.4,102.4H375.467V25.6c0-4.702,3.831-8.533,8.533-8.533h34.133c4.702,0,8.533,3.831,8.533,8.533v8.533h-8.533 c-4.71,0-8.533,3.823-8.533,8.533c0,4.71,3.823,8.533,8.533,8.533h8.533v17.067h-8.533c-4.71,0-8.533,3.823-8.533,8.533 s3.823,8.533,8.533,8.533H435.2c4.71,0,8.533-3.823,8.533-8.533V25.6c0-14.114-11.486-25.6-25.6-25.6H384 c-14.114,0-25.6,11.486-25.6,25.6v81.801l-12.066,12.066H165.666L153.6,107.401V25.6C153.6,11.486,142.114,0,128,0H93.867 c-14.114,0-25.6,11.486-25.6,25.6v51.2c0,4.71,3.823,8.533,8.533,8.533s8.533-3.823,8.533-8.533V25.6 c0-4.702,3.831-8.533,8.533-8.533H128c4.702,0,8.533,3.831,8.533,8.533v8.533H128c-4.71,0-8.533,3.823-8.533,8.533 c0,4.71,3.823,8.533,8.533,8.533h8.533v17.067H128c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533h8.533V102.4H25.6 C11.486,102.4,0,113.886,0,128v34.133c0,11.11,7.151,20.489,17.067,24.021v283.179c0,23.526,19.14,42.667,42.667,42.667h392.533 c23.526,0,42.667-19.14,42.667-42.667v-256c0-4.71-3.823-8.533-8.533-8.533s-8.533,3.823-8.533,8.533v256 c0,14.114-11.486,25.6-25.6,25.6H59.733c-14.114,0-25.6-11.486-25.6-25.6V179.2c0-4.71-3.823-8.533-8.533-8.533 c-4.702,0-8.533-3.831-8.533-8.533V128c0-4.702,3.831-8.533,8.533-8.533h115.934l14.566,14.566c1.596,1.596,3.772,2.5,6.033,2.5 h187.733c2.261,0,4.429-0.905,6.033-2.5l14.566-14.566H486.4c4.702,0,8.533,3.831,8.533,8.533v34.133 c0,4.702-3.831,8.533-8.533,8.533H59.733c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533H486.4 c14.114,0,25.6-11.486,25.6-25.6V128C512,113.886,500.514,102.4,486.4,102.4z"/><path d="M366.933,341.333c-4.71,0-8.533,3.823-8.533,8.533s3.823,8.533,8.533,8.533H435.2c4.71,0,8.533-3.823,8.533-8.533 s-3.823-8.533-8.533-8.533H366.933z"/><path d="M226.534,442.812c1.229,0.623,2.551,0.922,3.857,0.922c2.475,0,4.898-1.075,6.562-3.072l85.333-102.4 c2.125-2.543,2.577-6.084,1.178-9.079c-1.408-2.995-4.42-4.915-7.731-4.915h-40.789l15.019-75.127 c0.794-3.942-1.28-7.902-4.966-9.498c-3.686-1.604-8.004-0.401-10.342,2.867l-85.333,119.467 c-1.852,2.603-2.108,6.016-0.64,8.866c1.459,2.833,4.386,4.625,7.586,4.625h40.269l-14.413,57.66 C221.158,436.992,222.985,441.011,226.534,442.812z M212.847,358.4l52.582-73.617l-9.267,46.345 c-0.503,2.509,0.154,5.103,1.775,7.083s4.036,3.123,6.596,3.123h32.981l-49.792,59.742l8.021-32.068 c0.64-2.551,0.06-5.257-1.553-7.322c-1.613-2.074-4.096-3.285-6.724-3.285H212.847z"/><path d="M110.933,392.533c4.71,0,8.533-3.823,8.533-8.533v-25.6h25.6c4.71,0,8.533-3.823,8.533-8.533s-3.823-8.533-8.533-8.533 h-25.6v-25.6c0-4.71-3.823-8.533-8.533-8.533s-8.533,3.823-8.533,8.533v25.6H76.8c-4.71,0-8.533,3.823-8.533,8.533 S72.09,358.4,76.8,358.4h25.6V384C102.4,388.71,106.223,392.533,110.933,392.533z"/></g></g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>',
            'tire_fitting' => '<svg version="1.1" id="Capa_1" height="' . $height . '" width="' . $width . '" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 254.532 254.532" style="enable-background:new 0 0 254.532 254.532;" xml:space="preserve"><g><path d="M127.267,0C57.092,0,0,57.091,0,127.266s57.092,127.266,127.267,127.266c70.174,0,127.266-57.091,127.266-127.266 S197.44,0,127.267,0z M127.267,217.656c-49.922,0-90.391-40.468-90.391-90.39s40.469-90.39,90.391-90.39 c49.92,0,90.39,40.468,90.39,90.39S177.186,217.656,127.267,217.656z"/><path d="M127.267,48.578c-43.39,0-78.689,35.299-78.689,78.688c0,43.389,35.3,78.688,78.689,78.688 c43.389,0,78.688-35.299,78.688-78.688C205.955,83.877,170.655,48.578,127.267,48.578z M195.878,122.249h-38.18c-0.78-4.825-2.686-9.275-5.435-13.079l26.954-26.954C188.679,93.112,194.771,106.996,195.878,122.249z M132.204,58.648 c15.244,1.087,29.123,7.156,40.025,16.591l-26.948,26.949c-3.804-2.748-8.253-4.653-13.077-5.433V58.648z M122.329,58.648v38.106 c-4.824,0.78-9.274,2.685-13.078,5.434L82.302,75.24C93.204,65.805,107.085,59.735,122.329,58.648z M75.313,82.217l26.955,26.954 c-2.749,3.803-4.654,8.253-5.434,13.077h-38.18C59.761,106.996,65.853,93.113,75.313,82.217z M58.643,132.123h38.192 c0.779,4.824,2.685,9.274,5.434,13.078l-27.029,27.029C65.788,161.308,59.714,147.398,58.643,132.123z M122.329,195.884 c-15.285-1.09-29.197-7.188-40.113-16.666l27.035-27.035c3.804,2.749,8.254,4.654,13.078,5.434V195.884z M122.329,147.459v0.072 c-2.131-0.518-4.131-1.36-5.953-2.474l0.047-0.047c-2.85-1.738-5.244-4.132-6.982-6.983l-0.046,0.046 c-1.114-1.822-1.956-3.821-2.474-5.952h0.071c-0.385-1.585-0.611-3.233-0.611-4.937c0-1.704,0.227-3.352,0.611-4.937h-0.071 c0.518-2.13,1.359-4.129,2.474-5.951l0.046,0.046c1.738-2.85,4.133-5.245,6.982-6.982l-0.047-0.047 c1.822-1.114,3.822-1.957,5.953-2.474v0.072c1.586-0.385,3.233-0.612,4.938-0.612s3.352,0.227,4.938,0.612v-0.072 c2.131,0.518,4.13,1.359,5.951,2.473l-0.047,0.047c2.851,1.737,5.245,4.132,6.983,6.982l0.046-0.046 c1.115,1.822,1.957,3.822,2.475,5.953h-0.071c0.385,1.585,0.611,3.233,0.611,4.937c0,1.704-0.227,3.352-0.611,4.937h0.071 c-0.518,2.131-1.359,4.131-2.475,5.953l-0.046-0.046c-1.738,2.85-4.133,5.244-6.983,6.982l0.047,0.046 c-1.821,1.114-3.82,1.956-5.951,2.474v-0.072c-1.586,0.385-3.233,0.612-4.938,0.612S123.915,147.845,122.329,147.459z M132.204,195.884v-38.267c4.824-0.78,9.273-2.685,13.077-5.433l27.034,27.034C161.4,188.696,147.488,194.794,132.204,195.884z M179.292,172.23l-27.028-27.028c2.749-3.804,4.654-8.254,5.435-13.079h38.191C194.818,147.398,188.745,161.308,179.292,172.23z"/></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>',
        ];

        return $typeNameToPictureMap[$typeName];
    }

    public function getCountryName() {
        return $this->belongsTo(
            Country::class,
            'country_id'
        )->first()->name;
    }

    public function getAuthor() {
        return $this->belongsTo(
            User::class,
            'author_id'
        )->first();
    }

    public function pictures() {
        return $this->belongsToMany('App\Models\Picture')
            ->using('App\Models\EventPicture');
    }

    public function getMainPicture() {
        $firstPicture = $this->pictures->first();

        if (!empty($firstPicture)) {
            return ($firstPicture->path);
        }

        return '';
    }
}
