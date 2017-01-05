<publisher-profile inline-template>
    <div>
        <div class="row" v-if="loading">
            <div class="col-sm-12">
                <div class="panel panel-default">
                    <div class="panel-body">
                        <i class="fa fa-btn fa-spinner fa-spin"></i>Loading
                    </div>
                </div>
            </div>
        </div>

        <div class="row" v-if=" ! loading && error">
            <div class="panel panel-default" v-if="error">
                <div class="panel-heading">
                    <i class="fa fa-btn fa-times" style="cursor: pointer;" @click="showSearch()"></i>
                    Error
                </div>

                <div class="panel-body">
                    <strong>@{{ error }}</strong>
                </div>
            </div>
        </div>

        <div v-if=" ! loading && publisher">
            <div class="row">
                <div class="col-sm-12">
                    <div class="panel panel-default panel-flush">
                        <!-- Create Button -->
                        <button type="submit" class="btn btn-primary btn-block" @click="addStat()">
                            <i class="fa fa-plus"></i> Add Stat
                        </button>
                    </div>

                    <div class="panel panel-default" v-if="publisher">
                        <div class="panel-heading">
                            @{{ publisher.first_name }} @{{ publisher.last_name }} Stats
                        </div>

                        <div class="panel-body">
                            <div v-if="stats.length">
                                <table class="table table-bordered table-hover table-responsive">
                                    <thead>
                                        <tr>
                                            <th>Date</th>
                                            <th>Site</th>
                                            <th>Tag</th>
                                            <th>Impressions</th>
                                            <th>Served</th>
                                            <th>Fill</th>
                                            <th>Income</th>
                                            <th>eCPM</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr v-for="stat in stats">
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ stat.date }}</td>
                                            <td v-else @click="editStat(stat)">@{{ stat.date }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ stat.site }}</td>
                                            <td v-else @click="editStat(stat)">@{{ stat.site }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ stat.tag }}</td>
                                            <td v-else @click="editStat(stat)">@{{ stat.tag }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ stat.impressions }}</td>
                                            <td v-else @click="editStat(stat)">@{{ stat.impressions }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ stat.served }}</td>
                                            <td v-else @click="editStat(stat)">@{{ stat.served }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">@{{ fill_rate(stat).toFixed(2) }}%</td>
                                            <td v-else @click="editStat(stat)">@{{ fill_rate(stat).toFixed(2) }}%</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">$@{{ stat.income }}</td>
                                            <td v-else @click="editStat(stat)">$@{{ stat.income }}</td>
                                            <td style="font-weight: bold" v-if="stat.tag.includes('Total')" @click="editStat(stat)">$@{{ eCPM_calc(stat).toFixed(2) }}</td>
                                            <td v-else @click="editStat(stat)">$@{{ eCPM_calc(stat).toFixed(2) }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div v-else>
                                <p>There are no stats for this publisher at this time.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Update Publisher Information -->
                    @include('admin.update-publisher-info')
                </div>
            </div>
        </div>

        <div>
            @include('admin.modals.add-stat')
        </div>

        <div>
            @include('admin.modals.edit-stat')
        </div>
    </div>
</department-profile>