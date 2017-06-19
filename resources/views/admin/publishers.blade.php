<publishers :publishers="publishers" inline-template>
    <div>
        <div class="panel panel-default panel-flush" v-show=" ! showingPublisherProfile">
            <!-- Create Button -->
            <button type="submit" class="btn btn-primary btn-block" @click="addPublisher()">
                <i class="fa fa-plus"></i> Add Publisher
            </button><br>
                <a href="admin/download" class="btn btn-primary btn-block"><i class="fa fa-cloud-download"></i> Download Publisher's Stats</a>
        </div>

        <!-- <div v-show=" ! showingPublisherProfile"> -->
            <!-- Search Field Panel -->
            <!-- <div class="panel panel-default panel-flush" style="border: 0;">
                <div class="panel-body">
                    <form class="form-horizontal p-b-none" role="form" @submit.prevent>
                        {{ csrf_field() }} -->

                        <!-- Search Field -->
                        <!-- <div class="form-group m-b-none">
                            <div class="col-md-12">
                                <input type="text" id="admin-publisher-search" class="form-control"
                                    name="pub_search"
                                    placeholder="Search By Publisher Name..."
                                    v-model="searchForm.query"
                                    @keyup.enter="search">
                            </div>
                        </div>
                    </form>
                </div>
            </div> -->

            <!-- Searching -->
            <!-- <div class="panel panel-default" v-if="searching">
                <div class="panel-heading">Search Results</div>

                <div class="panel-body">
                    <i class="fa fa-btn fa-spinner fa-spin"></i>Searching
                </div>
            </div> -->

            <!-- No Search Results -->
            <!-- <div class="panel panel-warning" v-if=" ! searching && noSearchResults">
                <div class="panel-heading">Search Results</div>

                <div class="panel-body">
                    No publishers matched the given criteria.
                </div>
            </div> -->

            <!-- Publisher Search Results -->
            <!-- <div class="panel panel-default" v-if=" ! searching && searchResults.length > 0">
                <div class="panel-heading">Search Results</div>

                <div class="panel-body">
                    <table class="table table-borderless m-b-none">
                        <thead>
                            <th>Publisher Name</th>
                            <th></th>
                        </thead>

                        <tbody>
                            <tr v-for="searchPublisher in searchResults"> -->
                                <!-- Publisher Name -->
                                <!-- <td>
                                    <div class="btn-table-align">
                                        @{{ searchPublisher.name }}
                                    </div>
                                </td>

                                <td> -->
                                    <!-- View Publisher Profile -->
                                    <!-- <button class="btn btn-default" @click="showPublisherProfile(searchPublisher)">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div> -->
        <!-- </div> -->

        <!-- List all Publishers -->
        <div v-show=" ! showingPublisherProfile && ! searching && ! searchResults.length && ! noSearchResults">
            <div class="panel panel-default">
                <div class="panel-heading">Publishers</div>

                <div class="panel-body">
                    <ul class="list-group">
                        <li class="list-group-item" v-for="publisher in publishers" @click="showPublisherProfile(publisher)">
                            @{{ publisher.first_name }} @{{ publisher.last_name }}
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Publisher Profile Detail -->
        <div v-show="showingPublisherProfile">
            @include('admin.publisher-profile')
        </div>

        <!-- Add Publisher Modal -->
        <div>
            @include('admin.modals.add-publisher')
        </div>
    </div>
</publishers>