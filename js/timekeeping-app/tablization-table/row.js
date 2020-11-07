class Row {
    constructor(item, properties, columnWidths, columnNames, rowWidth, rowConfig, buttons, buttonFunctions, rowClickFunction) {

        this.item = item;
        this.properties = properties;
        this.columnWidths = columnWidths;
        this.columnNames = columnNames;
        this.rowWidth = rowWidth;
        this.rowConfig = rowConfig;
        this.buttonFunctions = buttonFunctions;
        this.rowClickFunction = rowClickFunction;


        this.columnCells = [];
        this.row;
        this.buttons = buttons;

    }

    createRow() {

        this.row = document.createElement('div');
        this.row.className = 'table-row';

        this.row.style.width = (this.rowWidth + 'px');
        let cell;
        let count = 0;
        let columnCells = [];

        let rowCellDiv = document.createElement('div');
        rowCellDiv.className = 'table-row-cells';

        this.properties.forEach((property) => {
            cell = new Cell(this.item[property], property, 50, this.columnWidths[count], count, this.item);
            rowCellDiv.append(cell.getCell());
            count += 1;
            columnCells.push(cell);
        });

        this.row.append(rowCellDiv);

        let buttonsDiv = document.createElement('div');
        buttonsDiv.className = 'row-buttons-div';

        this.columnCells = columnCells;

        let rowClickFunction = this.rowClickFunction
        let item = this.item
        this.row.addEventListener('click', function () {
            rowClickFunction(item);
        })

    }

    createHeaderRow() {

        this.row = document.createElement('div');
        this.row.className = 'table-row';
        this.row.style.width = (this.rowWidth + 'px');
        let cell;
        let count = 0;

        for (var key in this.columnNames) {

            cell = new Cell('', this.columnNames[count], 50, this.columnWidths[count], -1);
            this.row.append(cell.getHeaderCell());
            count += 1;
            this.columnCells.push(cell);

        }




    }

    getRow() {
        this.createRow();
        return this.row;
    }

    getHeaderRow() {
        this.createHeaderRow();
        return this.row;
    }

    getColumns() {
        return this.columnCells;
    }

}