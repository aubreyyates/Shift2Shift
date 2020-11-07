class Cell {

    constructor(data, key, height, width, rowId, item) {
        this.height = height;
        this.width = width;
        this.data = data;
        this.key = key;
        this.rowId = rowId;
        this.item = item;
        this.createCell();
    }

    createCell() {
        this.cell = document.createElement('div');
        this.cell.className = 'table-cell';
        this.cell.style.width = (this.width + 'px');

        let input = document.createElement('input');
        input.value = this.data;
        input.readOnly = true;
        input.addEventListener('input', (e) => {
            this.item[this.key] = e.target.value;
        }, false)

        this.cell.append(input);
        //this.cell.innerHTML = `<input data-row-id='${this.rowId}' data-key='${this.key}' class='table-cell-input' value='${this.data}'>`;

    }

    getCell() {
        this.createCell();
        return this.cell;
    }

    createHeaderCell() {
        this.cell = document.createElement('div');
        this.cell.className = 'table-cell heading-cell';
        this.cell.style.width = (this.width + 'px');
        this.cell.innerHTML = `${this.key}`;
    }


    getHeaderCell() {
        this.createHeaderCell();
        return this.cell;
    }
}