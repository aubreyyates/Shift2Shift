function sort_dropdown(order, property, table, type = 'letter') {

    if (type == 'letter') {
        table.items = sort_items(table.items, property)
    } else if (type == 'number') {
        table.items = sort_items_by_number(table.items, property)
    }

    if (order == "descending") {
        console.log("here");
        table.items = table.items.reverse();
    }

    table.draw();

}

