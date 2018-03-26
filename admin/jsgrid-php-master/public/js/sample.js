$(function() {
        $("#jsGrid").jsGrid({
            height: "100%",
            width: "100%",
            filtering: true,
            inserting: true,
            editing: true,
            sorting: true,
            paging: true,
            autoload: true,
            pageSize: 10,
            pageButtonCount: 5,
            deleteConfirm: "Do you really want to delete client?",
            controller: {
                loadData: function(filter) {
                    var data= $.ajax({
                        type: "GET",
                        url: "jsgrid-php-master/clients/index.php",
                        data: filter
                    });
                    return data;
                },
                insertItem: function(item) {
                    return $.ajax({
                        type: "POST",
                        url: "jsgrid-php-master/clients/index.php",
                        data: item
                    });
                },
                updateItem: function(item) {
                    return $.ajax({
                        type: "PUT",
                        url: "jsgrid-php-master/clients/index.php",
                        data: item
                    });
                },
                deleteItem: function(item) {
                    return $.ajax({
                        type: "DELETE",
                        url: "jsgrid-php-master/clients/index.php",
                        data: item
                    });
                }
            },
            fields: [
                { name: "sn", title: "SN", type: "text",filtering: true },
                { name: "issn", title: "ISSN", type: "text",filtering: true},
                { name: "callno", title: "CallNo", type: "text",filtering: true},
                { name: "title", type: "text", title: "Title",filtering: true},
                { name: "author", type: "text", title: "Author",filtering: true},
                { name: "publisher", type: "text", title: "Publisher",filtering: true},
                { name: "place", type: "text", title: "Place",filtering: true},
                { name: "year", type: "text", title: "Year",filtering: true},
                { name: "accessible_from", type: "text", title: "Accessible_from",filtering: true},
                { name: "accessible_upto", type: "text", title: "Accessible_upto",filtering: true},
                { name: "url", type: "text", title: "URL",filtering: true},
                { name: "subject", type: "text", title: "Subject",filtering: true},
                { name: "notes", type: "text", title: "Notes",filtering: true},
                { name: "accessionNo", type: "text", title: "AccessionNo",filtering: true},
                { type: "control" }
            ]
        });

    });