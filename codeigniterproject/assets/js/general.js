
/*
* ajax data-table for users listing  
* @author  raghavendra
*/
$('#manage-users').DataTable({

    'processing': true,
    'serverSide': true,
   
    "dom": '<"row"<"col-xs-12 col-sm-4" <"top" l <" col-sm-6 mb-1" i> >><"col-xs-12 col-sm-8"f>>t<"row"<"col-sm-4"i><"col-sm-8"p>><"clear">',
    "pageLength": 25,
    "scrollY": "calc(100vh - 250px)", // for making column name sticky
    "stateSave": true,
    "scrollX": true,
    "scrollCollapse": true,
    // "fixedColumns": { // for making starting colimn sticky
    //     leftColumns: 4,
    // },
    'serverMethod': 'post',
    'ajax': {
        'url': base_url + 'form_validate/get_users',
    },
    'order': [
        [2, 'asc']
    ],
    "columnDefs": [ // sorting
        { orderable: false, targets: [0, 1] },
        // { "targets": 1, "orderable": false, 'name': '' },
        { "targets": 2, "name": "vName" },
        { "targets": 3, "name": "vEmail" },
        { "targets": 4, "name": "vMobileNo" },
        { "targets": 5, "name": "vPassword" },
        { "targets": 6, "name": "vCity" },
    ],
    "lengthMenu": [[10, 25, 50, -1], [10, 25, 50, "All"]],
   
});
