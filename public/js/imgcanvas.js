"use strict"

let spriteSources = [];

let sprites = [];

const canvas = document.getElementById("elementsZoneCanvas");
var canvasctx, canvasRect;

let isOnMobile = navigator.userAgent.match(/mobile/i);
let resizeCoef = 1;
let mouseClicked = false;
let selectedElement = null;
let selectionMouseOffset = null;



document.onmousedown = function (e) {
    mouseClicked = true;
}



document.onmouseup = function () {
    if (selectedElement != null) {
        localStorage.setItem(selectedElement.id, JSON.stringify({x: selectedElement.x, y: selectedElement.y}));
    }
    mouseClicked = false;
    selectedElement = null;
    selectionMouseOffset = null;
}



class Sprite {
    constructor (id, element, mobileCoord) {
        this.id = String(id);
        this.element = element;

        let savedCoords = localStorage.getItem(this.id);
        if (isOnMobile) {
            this.x = mobileCoord[0] * resizeCoef;
            this.y = mobileCoord[1] * resizeCoef;
        }

        else {
            if (savedCoords != null) {
                savedCoords = JSON.parse(savedCoords);
                this.x = savedCoords.x;
                this.y = savedCoords.y;
            }
            else {
                this.x = Math.floor(Math.random() * (canvasRect.width-this.element.width));
                this.y = Math.floor(Math.random() * (canvasRect.height-this.element.height));
                localStorage.setItem(this.id, JSON.stringify({x: this.x, y: this.y}));
            }
        }

        this.draw();

        this.localCanvas = document.createElement('canvas');
        this.localCanvas.width = this.element.width;
        this.localCanvas.height = this.element.height;

		this.localCanvasCtx = this.localCanvas.getContext('2d');
        this.localCanvasCtx.drawImage(this.element, 0, 0, this.element.width, this.element.height);
    }


    draw () {
        canvasctx.drawImage(this.element, this.x, this.y, this.element.width, this.element.height);
    }


    isMouseOver (coord) {
        let localX = coord.x - canvasRect.left - this.x;
        let localY = coord.y - canvasRect.top - this.y;

        if (localX<0 || localX>this.element.width) return null;
        if (localY<0 || localY>this.element.height) return null;

        if (this.isOnTransparent({x:localX, y:localY})) return null;

        return {x:localX, y:localY};
    }


    isOnTransparent (coord) {
        let alpha = this.localCanvasCtx.getImageData(coord.x, coord.y, 1, 1).data[3];
        return alpha < 1;
    }


    moveAtMouse (e, mouseOffset=null) {
        this.x = e.clientX - canvasRect.left;
        this.y = e.clientY - canvasRect.top;

        if (mouseOffset !== null) {
            this.x -= mouseOffset.x;
            this.y -= mouseOffset.y;
        }
    }
}



function init () {
    canvasctx = canvas.getContext("2d");
    canvasRect = canvas.getBoundingClientRect();

    canvas.width = canvasRect.width;
    canvas.height = canvasRect.height;
    resizeCoef = canvasRect.width/3000;

    for (let i of spriteSources) {
        let img = new Image;
        img.onload = function(){
            img.width = img.width * resizeCoef;
            img.height = img.height * resizeCoef;
            sprites.push(new Sprite(i.id, img, i.mobileCoord));
        };
        img.src = i.src;
    }
}


window.onload = function () {
    fetch('/geocache/enigme').then(response => {
        response.json().then(data => {
            spriteSources = data.spriteSources

            init()

            window.dispatchEvent(new Event('riddle_loaded'))
        })
    })
}

window.addEventListener('riddle_loaded', event => {

    window.onresize = function () {
        canvasctx.clearRect(0, 0, canvas.width, canvas.height);
        sprites = [];
        init();
    }


    window.onscroll = function () {
        canvasRect = canvas.getBoundingClientRect();
    }



    canvas.onmousemove = function (e) {
        canvasctx.clearRect(0, 0, canvas.width, canvas.height);

        if (selectedElement == null) {
            let i = sprites.length-1;

            while (i >= 0 && selectedElement == null && mouseClicked) {
                let s = sprites[i];
                let mouseRel = s.isMouseOver({x:e.clientX, y:e.clientY});
                if (mouseRel !== null) {
                    selectedElement = s;
                    selectionMouseOffset = mouseRel;

                    sprites.push(sprites.splice(i, 1)[0])
                }
                i--;
            }
        }

        if (selectedElement != null) {
            selectedElement.moveAtMouse(e, selectionMouseOffset);
        }

        for (let i=0; i<sprites.length; i++) {
            sprites[i].draw();
        }
    }

})
