    <table border="1" class="table">
        <thead>
            <tr>
                <th>code auth</th>
                <th>nbr bug in</th>
                <th>nbr bug out</th>
                <th>nbr cmd erreur</th>
                <th>nbr erreur in</th>
                <th>nbr erreur out</th>
                <th>nbr sync in</th>
                <th>nbr sync out</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{info?.totalCodeAuth}}</td>
                <td>{{info?.totalBugIn}}</td>
                <td>{{info?.totalBugOut}}</td>
                <td>{{info?.totalCmdErreur}}</td>
                <td>{{info?.totalErreurIn}}</td>
                <td>{{info?.totalErreurOut}}</td>
                <td>{{info?.totalSyncIn}}</td>
                <td>{{info?.totalSyncOut}}</td>
            </tr>         
        </tbody>
    </table>


    <table border="1" class="table">
        <thead>
            <tr>
                <th>code auth</th>
                <th>date last sync</th>
                <th>nbr bug in</th>
                <th>nbr bug out</th>
                <th>nbr cmd erreur</th>
                <th>nbr erreur in</th>
                <th>nbr erreur out</th>
                <th>nbr sync in</th>
                <th>nbr sync out</th>
            </tr>
        </thead>
            <tbody>
            <tr v-for="(item, index) in info?.data" :key="index">
                <td>{{ item.code_auth }}</td>
                <td>{{ item.nbr_bug_in }}</td>
                <td>{{ item.nbr_bug_out }}</td>
                <td>{{ item.nbr_cmd_erreur }}</td>
                <td>{{ item.nbr_erreur_in }}</td>
                <td>{{ item.nbr_erreur_out }}</td>
                <td>{{ item.nbr_sync_in }}</td>
                <td>{{ item.nbr_sync_out ?? 'NO DATA' }}</td>
            </tr>
            </tbody>
    </table>


























