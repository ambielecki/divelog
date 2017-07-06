@push('head_scripts')
<link rel="stylesheet" href="/css/divelog.css">
@endpush

<div class="row">
    <div class="col s12 m6 l4">
        <fieldset>
            <legend>General Info</legend>
            <div class="row">
                <div class="input-field col s12">
                    <input id="location" type="text" name="location" value="{{ old('location') ?? $dive_log->location }}">
                    <label for="location">Location</label>
                    @if ($errors->has('location'))
                        <span class="red-text text-darken-2">
                        <strong>{{ $errors->first('location') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="dive_site" type="text" name="dive_site" value="{{ old('dive_site') ?? $dive_log->dive_site }}">
                    <label for="dive_site">Dive Site</label>
                    @if ($errors->has('dive_site'))
                        <span class="red-text text-darken-2">
                        <strong>{{ $errors->first('dive_site') }}</strong>
                    </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s12">
                    <label for="date">Date </label>
                    <input type="text" class="datepicker" name="date" id="date" value="{{ old('date') ? old('date') : ($dive_log->date ? date_format(date_create_from_format('Y-m-d', $dive_log->date), 'j M, Y') : '') }}">
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6 m3">
                    <label for="time_in">Time In </label>
                    <input type="text" name="time_in" id="time_in" value="{{ old('time_in') ?? $dive_log->time_in }}">
                    @if ($errors->has('time'))
                        <span class="red-text text-darken-2">
                        <strong>{{ $errors->first('time_in') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-field col s6 m3">
                    <select name="in_am_pm" id="in_am_pm">
                        <option value="am" {{ old('in_am_pm') == 'am' ? 'selected' : ($dive_log->in_am_pm == 'am' ? 'selected' : '') }}>AM</option>
                        <option value="pm" {{ old('in_am_pm') == 'pm' ? 'selected' : ($dive_log->in_am_pm == 'pm' ? 'selected' : '') }}>PM</option>
                    </select>
                    <label for="am_pm">AM / PM</label>
                </div>
                <div class="input-field col s6 m3">
                    <label for="time_out">Time Out </label>
                    <input type="text" name="time_out" id="time_out" value="{{ old('time_out') ?? $dive_log->time_out }}">
                    @if ($errors->has('time_out'))
                        <span class="red-text text-darken-2">
                        <strong>{{ $errors->first('time_out') }}</strong>
                    </span>
                    @endif
                </div>
                <div class="input-field col s6 m3">
                    <select name="out_am_pm" id="out_am_pm">
                        <option value="am" {{ old('out_am_pm') == 'am' ? 'selected' : ($dive_log->out_am_pm == 'am' ? 'selected' : '') }}>AM</option>
                        <option value="pm" {{ old('out_am_pm') == 'pm' ? 'selected' : ($dive_log->out_am_pm == 'pm' ? 'selected' : '') }}>PM</option>
                    </select>
                    <label for="am_pm">AM / PM</label>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m6 l4">
        <fieldset>
            <legend>Calculations</legend>
            <div class="row">
                <div class="input-field col s12">
                    <input id="previous_pg" type="text" name="previous_pg" value="{{ old('previous_pg') ?? $dive_log->previous_pg }}">
                    <label for="previous_pg">Previous Dive End PG</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="surface_interval" type="text" name="surface_interval" value="{{ old('surface_interval') ?? $dive_log->surface_interval }}">
                    <label for="surface_interval">Surface Interval (min)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="bottom_time" type="text" name="bottom_time" value="{{ old('bottom_time') ?? $dive_log->bottom_time }}">
                    <label for="bottom_time">Bottom Time (min)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="max_depth" type="text" name="max_depth" value="{{ old('max_depth') ?? $dive_log->max_depth }}">
                    <label for="max_depth">Max Depth (ft)</label>
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <input id="pressure_group" type="text" name="pressure_group" value="{{ old('pressure_group') ?? $dive_log->pressure_group }}">
                    <label for="pressure_group">Pressure Group</label>
                </div>
                <div class="input-field col s6">
                    <button class="btn blue darken-4" id="calculate_pg">Calculate PG</button>
                </div>
            </div>
            <div class="row" id="calculator_messages">
                <div v-if="error_messages" class="red-text text-darken-2">
                    <dive-errors :dive_error_messages="error_messages"></dive-errors>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m6 l4">
        <fieldset>
            <legend>Tank Info</legend>
            <div class="row">
                <div class="input-field col s6">
                    <label for="tank[type]">Tank Type </label>
                    <input type="text" name="tank[type]" id="tank[type]" value="{{ old('tank.type') ?? $dive_log->tank['type'] }}">
                    @if ($errors->has('tank.type'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('tank.type') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-field col s6">
                    <label for="tank[size]">Tank Size </label>
                    <input type="text" name="tank[size]" id="tank[size]" value="{{ old('tank.size') ?? $dive_log->tank['size'] }}">
                    @if ($errors->has('tank.size'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('tank.size') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s6">
                    <label for="tank[start_psi]">Start PSI </label>
                    <input type="text" name="tank[start_psi]" id="tank[start_psi]" value="{{ old('tank.start_psi') ?? $dive_log->tank['start_psi'] }}">
                    @if ($errors->has('tank.start_psi'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('tank.start_psi') }}</strong>
                        </span>
                    @endif
                </div>
                <div class="input-field col s6">
                    <label for="tank[end_psi]">End PSI </label>
                    <input type="text" name="tank[end_psi]" id="tank[end_psi]" value="{{ old('tank.end_psi') ?? $dive_log->tank['end_psi'] }}">
                    @if ($errors->has('tank.end_psi'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('tank.end_psi') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </fieldset>
        <div class="row">
            <div class="col s12">
                <label for="comments">Comments </label>
                <textarea id="comments" name="comments">{!! old('comments') ?? $dive_log->comments !!}</textarea>
                @if ($errors->has('comments'))
                    <span class="red-text text-darken-2">
                    <strong>{{ $errors->first('comments') }}</strong>
                </span>
                @endif
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 m6 l4">
        <div class="row">
            <fieldset>
                <legend>Environment</legend>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="environment[ocean]" id="environment[ocean]" {{ old("environment.ocean") || isset($dive_log->environment['ocean']) ? 'checked' : '' }}>
                        <label for="environment[ocean]" class="black-text">Ocean</label>
                    </p>
                    <p>
                        <input type="checkbox" name="environment[tropical]" id="environment[tropical]" {{ old("environment.tropical") || isset($dive_log->environment['tropical']) ? 'checked' : '' }}>
                        <label for="environment[tropical]" class="black-text">Tropical</label>
                    </p>
                    <p>
                        <input type="checkbox" name="environment[quary]" id="environment[quary]" {{ old("environment.quary") || isset($dive_log->environment['quary']) ? 'checked' : '' }}>
                        <label for="environment[quary]" class="black-text">Quary</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="environment[lake]" id="environment[lake]" {{ old("environment.lake") || isset($dive_log->environment['lake']) ? 'checked' : '' }}>
                        <label for="environment[lake]" class="black-text">Lake</label>
                    </p>
                    <p>
                        <input type="checkbox" name="environment[river]" id="environment[river]" {{ old("environment.river") || isset($dive_log->environment['river']) ? 'checked' : '' }}>
                        <label for="environment[river]" class="black-text">River</label>
                    </p>
                    <p>
                        <input type="checkbox" name="environment[cold_water]" id="environment[cold_water]" {{ old("environment.cold_water") || isset($dive_log->environment['cold_water']) ? 'checked' : '' }}>
                        <label for="environment[cold_water]" class="black-text">Cold Water</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <div class="input-field col s12">
                        <input id="environment[other]" type="text" name="environment[other]" value="{{ old('environment.other') ?? $dive_log->environment['other'] }}">
                        <label for="environment[other]">Other</label>
                        @if ($errors->has('environment.other'))
                            <span class="red-text text-darken-2">
                                <strong>{{ $errors->first('environment.other') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col s12 m6 l4">
        <div class="row">
            <fieldset>
                <legend>Dive Type</legend>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="type[boat]" id="type[boat]" {{ old("type.boat") || isset($dive_log->type['boat']) ? 'checked' : '' }}>
                        <label for="type[boat]" class="black-text">Boat</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[beach]" id="type[beach]" {{ old("type.beach") || isset($dive_log->type['beach']) ? 'checked' : '' }}>
                        <label for="type[beach]" class="black-text">Beach</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[drift]" id="type[drift]" {{ old("type.drift") || isset($dive_log->type['drift']) ? 'checked' : '' }}>
                        <label for="type[drift]" class="black-text">Drift</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[multi]" id="type[multi]" {{ old("type.multi") || isset($dive_log->type['multi']) ? 'checked' : '' }}>
                        <label for="type[multi]" class="black-text">Multi Level</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[training]" id="type[training]" {{ old("type.training") || isset($dive_log->type['training']) ? 'checked' : '' }}>
                        <label for="type[training]" class="black-text">Training</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="type[deep]" id="type[deep]" {{ old("type.deep") || isset($dive_log->type['deep']) ? 'checked' : '' }}>
                        <label for="type[deep]" class="black-text">Deep</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[night]" id="type[night]" {{ old("type.night") || isset($dive_log->type['night']) ? 'checked' : '' }}>
                        <label for="type[night]" class="black-text">Night</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[altitude]" id="type[altitude]" {{ old("type.altitude") || isset($dive_log->type['altitude']) ? 'checked' : '' }}>
                        <label for="type[altitude]" class="black-text">Altitude</label>
                    </p>
                    <p>
                        <input type="checkbox" name="type[ice]" id="type[ice]" {{ old("type.ice") || isset($dive_log->type['ice']) ? 'checked' : '' }}>
                        <label for="type[ice]" class="black-text">Ice</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <div class="input-field col s12">
                        <input id="type[other]" type="text" name="type[other]" value="{{ old('type.other') ?? $dive_log->type['other'] }}">
                        <label for="type[other]">Other</label>
                        @if ($errors->has('type.other'))
                            <span class="red-text text-darken-2">
                                <strong>{{ $errors->first('type.other') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
    <div class="col s12 m6 l4">
        <div class="row">
            <fieldset>
                <legend>Activities</legend>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="activities[wreck]" id="activities[wreck]" {{ old("activities.wreck") || isset($dive_log->activities['wreck']) ? 'checked' : '' }}>
                        <label for="activities[wreck]" class="black-text">Wreck Dive</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[reef]" id="activities[reef]" {{ old("activities.reef") || isset($dive_log->activities['reef']) ? 'checked' : '' }}>
                        <label for="activities[reef]" class="black-text">Reef Dive</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[cave]" id="activities[cave]" {{ old("activities.cave") || isset($dive_log->activities['cave']) ? 'checked' : '' }}>
                        <label for="activities[cave]" class="black-text">Cave Dive</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[training]" id="activities[training]" {{ old("activities.training") || isset($dive_log->activities['training']) ? 'checked' : '' }}>
                        <label for="activities[wreck]" class="black-text">Training</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[search]" id="activities[search]" {{ old("activities.search") || isset($dive_log->activities['search']) ? 'checked' : '' }}>
                        <label for="activities[search]" class="black-text">Search & Recov</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <p>
                        <input type="checkbox" name="activities[photo]" id="activities[photo]" {{ old("activities.photo") || isset($dive_log->activities['photo']) ? 'checked' : '' }}>
                        <label for="activities[photo]" class="black-text">UW Photo</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[nav]" id="activities[nav]" {{ old("activities.nav") || isset($dive_log->activities['nav']) ? 'checked' : '' }}>
                        <label for="activities[nav]" class="black-text">Wreck Nav</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[naturalist]" id="activities[naturalist]" {{ old("activities.naturalist") || isset($dive_log->activities['naturalist']) ? 'checked' : '' }}>
                        <label for="activities[naturalist]" class="black-text">UW Naturalist</label>
                    </p>
                    <p>
                        <input type="checkbox" name="activities[research]" id="activities[research]" {{ old("activities.research") || isset($dive_log->activities['research']) ? 'checked' : '' }}>
                        <label for="activities[research]" class="black-text">UW Research</label>
                    </p>
                </div>
                <div class="col s12 m6 l4">
                    <div class="input-field col s12">
                        <input id="activities[other]" type="text" name="activities[other]" value="{{ old('activities.other') ?? $dive_log->activities['other'] }}">
                        <label for="activities[other]">Other</label>
                        @if ($errors->has('activities.other'))
                            <span class="red-text text-darken-2">
                                <strong>{{ $errors->first('activities.other') }}</strong>
                            </span>
                        @endif
                    </div>
                </div>
            </fieldset>
        </div>
    </div>
</div>
<div class="row">
    <div class="col s12 m4 l2">
        <fieldset>
            <legend>Conditions</legend>
            <div class="row">
                <div class="col s12">
                    <p>
                        <input type="checkbox" name="conditions[calm]" id="conditions[calm]" {{ old("conditions.calm") || isset($dive_log->conditions['calm']) ? 'checked' : '' }}>
                        <label for="conditions[calm]" class="black-text">Calm</label>
                    </p>
                    <p>
                        <input type="checkbox" name="conditions[choppy]" id="conditions[choppy]" {{ old("conditions.choppy") || isset($dive_log->conditions['choppy']) ? 'checked' : '' }}>
                        <label for="conditions[choppy]" class="black-text">Chopppy</label>
                    </p>
                    <p>
                        <input type="checkbox" name="conditions[swells]" id="conditions[swells]" {{ old("conditions.swells") || isset($dive_log->conditions['swells']) ? 'checked' : '' }}>
                        <label for="conditions[swells]" class="black-text">Swells</label>
                    </p>
                    <p>
                        <input type="checkbox" name="conditions[current]" id="conditions[current]" {{ old("conditions.current") || isset($dive_log->conditions['current']) ? 'checked' : '' }}>
                        <label for="conditions[current]" class="black-text">Current</label>
                    </p>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="conditions[other]" type="text" name="conditions[other]" value="{{ old('conditions.other') ?? $dive_log->conditions['other'] }}">
                            <label for="conditions[other]">Other</label>
                            @if ($errors->has('conditions.other'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('conditions.other') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m4 l2">
        <fieldset>
            <legend>Tide</legend>
            <div class="row">
                <div class="col s12">
                    <p>
                        <input type="checkbox" name="tide[high]" id="tide[high]" {{ old("tide.high") || isset($dive_log->tide['high']) ? 'checked' : '' }}>
                        <label for="tide[high]" class="black-text">High</label>
                    </p>
                    <p>
                        <input type="checkbox" name="tide[low]" id="tide[low]" {{ old("tide.low") || isset($dive_log->tide['low']) ? 'checked' : '' }}>
                        <label for="tide[low]" class="black-text">Low</label>
                    </p>
                    <p>
                        <input type="checkbox" name="tide[slack]" id="tide[slack]" {{ old("tide.slack") || isset($dive_log->tide['slack']) ? 'checked' : '' }}>
                        <label for="tide[slack]" class="black-text">Slack</label>
                    </p>
                    <p>
                        <input type="checkbox" name="tide[salt]" id="tide[salt]" {{ old("tide.salt") || isset($dive_log->tide['salt']) ? 'checked' : '' }}>
                        <label for="tide[salt]" class="black-text">Saltwater</label>
                    </p>
                    <p>
                        <input type="checkbox" name="tide[fresh]" id="tide[fresh]" {{ old("tide.fresh") || isset($dive_log->tide['fresh']) ? 'checked' : '' }}>
                        <label for="tide[fresh]" class="black-text">Freshwater</label>
                    </p>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m4 l2">
        <fieldset>
            <legend>Weather</legend>
            <div class="row">
                <div class="col s12">
                    <p>
                        <input type="checkbox" name="weather[sunny]" id="weather[sunny]" {{ old("weather.sunny") || isset($dive_log->weather['sunny']) ? 'checked' : '' }}>
                        <label for="weather[sunny]" class="black-text">Sunny</label>
                    </p>
                    <p>
                        <input type="checkbox" name="weather[cloudy]" id="weather[cloudy]" {{ old("weather.cloudy") || isset($dive_log->weather['cloudy']) ? 'checked' : '' }}>
                        <label for="weather[cloudy]" class="black-text">Cloudy</label>
                    </p>
                    <p>
                        <input type="checkbox" name="weather[foggy]" id="weather[foggy]" {{ old("weather.foggy") || isset($dive_log->weather['foggy']) ? 'checked' : '' }}>
                        <label for="weather[foggy]" class="black-text">Foggy</label>
                    </p>
                    <p>
                        <input type="checkbox" name="weather[rain]" id="weather[rain]" {{ old("weather.rain") || isset($dive_log->weather['rain']) ? 'checked' : '' }}>
                        <label for="weather[rain]" class="black-text">Rain</label>
                    </p>
                    <p>
                        <input type="checkbox" name="weather[windy]" id="weather[windy]" {{ old("weather.windy") || isset($dive_log->weather['windy']) ? 'checked' : '' }}>
                        <label for="weather[windy]" class="black-text">Windy</label>
                    </p>
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m4 l2">
        <fieldset>
            <legend>Temperature</legend>
            <div class="row">
                <div class="input-field col s12">
                    <input id="temperature[air]" type="text" name="temperature[air]" value="{{ old('temperature.air') ?? $dive_log->temperature['air'] }}">
                    <label for="temperature[air]">Air</label>
                    @if ($errors->has('temperature.air'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('temperature.air') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="temperature[surface]" type="text" name="temperature[surface]" value="{{ old('temperature.surface') ?? $dive_log->temperature['surface'] }}">
                    <label for="temperature[surface]">Surface</label>
                    @if ($errors->has('temperature.surface'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('temperature.surface') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="input-field col s12">
                    <input id="temperature[bottom]" type="text" name="temperature[bottom]" value="{{ old('temperature.bottom') ?? $dive_log->temperature['bottom'] }}">
                    <label for="temperature[bottom]">Bottom</label>
                    @if ($errors->has('temperature.bottom'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('temperature.bottom') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
    <div class="col s12 m4 l2">
        <div class="row">
            <div class="col s12">
                <fieldset>
                    <legend>Visibility</legend>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="visibility" type="text" name="visibility" value="{{ old('visibility') ?? $dive_log->visibility }}">
                            <label for="visibility">Visibility</label>
                            @if ($errors->has('visibility'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('visibility') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
        <div class="row">
            <div class="col s12">
                <fieldset>
                    <legend>Weight</legend>
                    <div class="row">
                        <div class="input-field col s12">
                            <input id="weight" type="text" name="weight" value="{{ old('weight') ?? $dive_log->weight }}">
                            <label for="weight">Weight</label>
                            @if ($errors->has('weight'))
                                <span class="red-text text-darken-2">
                                    <strong>{{ $errors->first('weight') }}</strong>
                                </span>
                            @endif
                        </div>
                    </div>
                </fieldset>
            </div>
        </div>
    </div>
    <div class="col s12 m4 l2">
        <fieldset class="wetsuit">
            <legend>Wet Suit</legend>
            <div class="row">
                <div class="col s6">
                    <p>
                        <input type="checkbox" name="wetsuit[full]" id="wetsuit[full]" {{ old("wetsuit.full") || isset($dive_log->wetsuit['full']) ? 'checked' : '' }}>
                        <label for="wetsuit[full]" class="black-text">Full</label>
                    </p>
                </div>
                <div class="col s6">
                    <input id="wetsuit[full_mm]" type="text" name="wetsuit[full_mm]" placeholder="mm" value="{{ old("wetsuit.full_mm") ?? $dive_log->wetsuit['full_mm'] }}">
                    @if ($errors->has('wetsuit.full_mm'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('wetsuit.full_mm') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p>
                        <input type="checkbox" name="wetsuit[shorty]" id="wetsuit[shorty]" {{ old("wetsuit.shorty") || isset($dive_log->wetsuit['shorty']) ? 'checked' : '' }}>
                        <label for="wetsuit[shorty]" class="black-text">Shorty</label>
                    </p>
                </div>
                <div class="col s6">
                    <input id="wetsuit[shorty_mm]" type="text" name="wetsuit[shorty_mm]" placeholder="mm" value="{{ old("wetsuit.shorty_mm") ?? $dive_log->wetsuit['shorty_mm'] }}">
                    @if ($errors->has('wetsuit.shorty_mm'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('wetsuit.shorty_mm') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p>
                        <input type="checkbox" name="wetsuit[hood]" id="wetsuit[hood]" {{ old("wetsuit.hood") || isset($dive_log->wetsuit['hood']) ? 'checked' : '' }}>
                        <label for="wetsuit[hood]" class="black-text">Hood</label>
                    </p>
                </div>
                <div class="col s6">
                    <input id="wetsuit[hood_mm]" type="text" name="wetsuit[hood_mm]" placeholder="mm" value="{{ old("wetsuit.hood_mm") ?? $dive_log->wetsuit['hood_mm'] }}">
                    @if ($errors->has('wetsuit[hood_mm]'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('wetsuit.hood_mm') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
            <div class="row">
                <div class="col s6">
                    <p>
                        <input type="checkbox" name="wetsuit[gloves]" id="wetsuit[gloves]" {{ old("wetsuit.gloves") || isset($dive_log->wetsuit['gloves']) ? 'checked' : '' }}>
                        <label for="wetsuit[gloves]" class="black-text">Gloves</label>
                    </p>
                </div>
                <div class="col s6">
                    <input id="wetsuit[gloves_mm]" type="text" name="wetsuit[gloves_mm]" placeholder="mm" value="{{ old("wetsuit.gloves_mm") ?? $dive_log->wetsuit['gloves_mm'] }}">
                    @if ($errors->has('wetsuit.gloves_mm'))
                        <span class="red-text text-darken-2">
                            <strong>{{ $errors->first('wetsuit.gloves_mm') }}</strong>
                        </span>
                    @endif
                </div>
            </div>
        </fieldset>
    </div>
</div>
<div class="row">
    <div class="col s12">
        <button type="submit" class="btn blue darken-4">Submit</button>
    </div>
</div>