function endResize() {
    console.log('endResize');

    window.removeEventListener('mousemove', mouseMove());
    window.removeEventListener("mouseup", endResize());


    //document.getElementById('heading-row').style.cursor = 'auto';
};

// // function endResize(e) {
// //     // console.log('endResize');

// //     // window.removeEventListener('mousemove', mouseMove);
// //     // window.removeEventListener('mouseup', endResize);

// //     // document.getElementById('heading-row').style.cursor = 'auto';
// // };


// function mouseMove() {
//     //Calculate the desired width
//     // console.log(this.selectedHeader);
//     // horizontalScrollOffset = document.documentElement.scrollLeft;
//     // let width = horizontalScrollOffset + e.clientX - this.selectedHeader.offsetLeft;
//     // this.selectedHeader.style.width = (width + 'px');

//     // this.selectedHeader.style.width = width;
//     // console.log(e.clientX);

// };