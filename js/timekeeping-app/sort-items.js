// This function will sort items by the given property.
// items - Items to be sorted
// property - The property the items will be sorted by

function sort_items(items, property) {

    var length = items.length;

    if (length === 1) {
        return [items[0]];
    }

    if (length === 2) {
        if (items[0][property].toLowerCase() > items[1][property].toLowerCase()) {
            return [items[1], items[0]];
        }

        return [items[0], items[1]];
    }

    var first = sort_items(items.slice(0, Math.ceil(length / 2)), property);
    var second = sort_items(items.slice(first.length), property);

    var result = [];

    while (first.length && second.length) {
        if (first[0][property].toLowerCase() > second[0][property].toLowerCase()) {
            result.push(second.shift());
        } else {
            result.push(first.shift());
        }
    }

    return result.concat(first, second);
}

function sort_items_by_number(items, property) {

    var length = items.length;

    if (length === 1) {
        return [items[0]];
    }

    if (length === 2) {
        if (items[0][property] > items[1][property]) {
            return [items[1], items[0]];
        }

        return [items[0], items[1]];
    }

    var first = sort_items_by_number(items.slice(0, Math.ceil(length / 2)), property);
    var second = sort_items_by_number(items.slice(first.length), property);

    var result = [];

    while (first.length && second.length) {
        if (first[0][property] > second[0][property]) {
            result.push(second.shift());
        } else {
            result.push(first.shift());
        }
    }

    return result.concat(first, second);
}