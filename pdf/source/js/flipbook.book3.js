/* v 3.17
author http://codecanyon.net/user/creativeinteractivemedia/portfolio?ref=creativeinteractivemedia
*/

var FLIPBOOK = FLIPBOOK || {};

FLIPBOOK.Book3 = function(el, model, options) {

    this.options = options
    this.model = model

    this.singlePage = options.singlePageMode
    this.pageWidth = this.options.pageWidth
    this.pageHeight = this.options.pageHeight

    this.wrapper = el
    this.$wrapper = jQuery(this.wrapper).addClass('flipbook-book3')
    this.$bookLayer = this.$wrapper.parent()
    this.bookLayer = this.$bookLayer[0]

    this.flipEasing = 'easeInOutCubic'
    this.flipEasing = 'easeOutSine'
    this.flipEasing = 'easeOutQuad'

    this.scroll = new FLIPBOOK.IScroll(this.bookLayer, {
        zoom: true,
        scrollX: true,
        scrollY: true,
        scrollbars: true,
        // mouseWheel: true,
        // wheelAction: 'zoom',
        keepInCenterV: true,
        keepInCenterH: true,
        freeScroll:true,
        // eventPassthrough:true,
        preventDefault: false, //for text selection and other events in html layer,

    });

    var self = this

    model.on("toolMove", function() {
        self.updateTool()
    })

    model.on("toolSelect", function() {
        self.updateTool()
    })

    this.scroll.on("zoomEnd", function() {

        // self.zooming = false

        if (isNaN(self.scroll.scale)) {
            self.zoomTo(options.zoomMin)
            return
        }
        options.main.onZoom(self.scroll.scale / self.ratio)
        var scale = options.main.zoom

        self.scroll.options.eventPassthrough = scale > 1 ? '' : 'vertical'
        // self.scroll.options.scrollY = scale > 1
        self.scroll.options.freeScroll = scale > 1
        // self.scroll.options.freeScroll = false

        self.scroll.refresh()
        // self.scroll.enable()
    })

    this.scroll.on('zoomStart', function() {
        
        // self.zooming = true
        // self.scroll.disable()
    })

    var s = this.wrapper.style;
    // s.width = String(2 * this.pageWidth) + 'px';
    /* if (this.singlePage)
        s.width = String(this.pageWidth) + 'px';
    else
        s.width = String(2 * this.pageWidth) + 'px';

*/

    s.width = String(2 * this.pageWidth) + 'px';
    s.height = String(this.pageHeight) + 'px';

    var perspective = (3 * this.pageHeight) + 'px'

    this.$centerContainer = jQuery('<div>').appendTo(this.$wrapper).addClass('flipbook-center-container3')
   /* if (this.options.singlePageMode) {
        this.$centerContainer.css({
            '-webkit-perspective-origin-x': '0',
            'perspective-origin-x': '0'
        })
    }*/

    this.$centerContainer.css({
        '-webkit-perspective': perspective,
        'perspective': perspective
    })


    this.centerContainerStyle = this.$centerContainer[0].style
    this.centerContainerStyle.width = 2 * this.pageWidth + 'px'
    this.centerContainerStyle.height = this.pageHeight + 'px'
    this.pagesArr = []
    this.animating = false;
    // this.rightIndex = 
    this.setRightIndex(options.rightToLeft ? options.pages.length : 0)

    self.updateFlipped()
    //create pages
    this.numPages = options.pages.length

    var page
    //double page mode
    for (var i = 0; i < options.numPages; i++) {
        page = new FLIPBOOK.Page3(this, i, options.pages[i].src, options.pages[i].htmlContent)
        page.hideHtml()
        this.pagesArr.push(page)
        this.$centerContainer.append(page.$wrapper)
        this.flippedright++;
        /*if (options.loadAllPages)
            page.load() */
    }
    this.pagesArr[0].show()

    this.nextEnabled = true
    this.prevEnabled = true
    //this.updateVisiblePages()

}


FLIPBOOK.Book3.prototype = Object.create(FLIPBOOK.Book.prototype)

FLIPBOOK.Book3.prototype.constructor = FLIPBOOK.Book3

FLIPBOOK.Book3.prototype.enableMouseWheelZoom = function() {

    this.scroll.options.eventPassthrough = 'vertical'
    this.scroll.refresh()

}

FLIPBOOK.Book3.prototype.disableMouseWheelZoom = function() {

    this.scroll.options.eventPassthrough = ''
    this.scroll.refresh()

}

FLIPBOOK.Book3.prototype.enablePrev = function(val) {

    this.prevEnabled = val

}

FLIPBOOK.Book3.prototype.enablePan = function() {

    this.scroll.enable()

}

FLIPBOOK.Book3.prototype.disablePan = function() {

    this.scroll.disable()

}

FLIPBOOK.Book3.prototype.setRightIndex = function(val) {

    this.rightIndex = val
    // $(this).trigger('rightIndexChange', [val])
    // this.options.main.onRightIndexChange(val)

}

FLIPBOOK.Book3.prototype.updateTool = function() {

    switch (this.options.main.tool) {

        case "toolSelect":
            this.disablePan()
            jQuery(".flipbook-textLayer").css("pointer-events", "auto").removeClass(".flipbook-noselect")
            break;

        case "toolMove":
            this.enablePan()
            jQuery(".flipbook-textLayer").css("pointer-events", "none").addClass(".flipbook-noselect")
            break;
    }

}

FLIPBOOK.Book3.prototype.enableNext = function(val) {

    this.nextEnabled = val

}

FLIPBOOK.Book3.prototype.isZoomed = function() {
    return this.options.main.zoom > this.options.zoomMin && this.options.main.zoom > 1
}

FLIPBOOK.Book3.prototype.onZoom = function() {
    /* if (!this.enabled) return;
     for (var i = 0; i < this.pagesArr.length; i++) {
         this.pagesArr[i].loaded = false
     }
     var self = this;
     setTimeout(function() {
         self.updateVisiblePages(false)
     }, 100); */
}

FLIPBOOK.Book3.prototype.getNumPages = function() {}


FLIPBOOK.Book3.prototype.move = function(direction) {
    if(this.zoom <= 1) return;
    // var posX = this.scroll.x, posY = this.scroll.y;
    // var offset = 200 * this.zoom
    // switch(direction){
    //     case 'left': posX += offset; break;
    //     case 'right': posX -= offset; break;
    //     case 'up': posY += offset; break;
    //     case 'down': posY -= offset; break;
    // }
    // this.scroll.scrollTo(posX, posY, 300)

    var iscroll = this.scroll
    var offset2 = 0

    if (iscroll){

        var posX = iscroll.x, posY = iscroll.y;
        var offset = 20 * this.zoom
        switch(direction){
            case 'left': posX += offset; break;
            case 'right': posX -= offset; break;
            case 'up': posY += offset; break;
            case 'down': posY -= offset; break;
        }

        if(posX > 0) posX = offset2;
        if(posX < iscroll.maxScrollX) posX = iscroll.maxScrollX - offset2;
        if(posY > 0) posY = offset2;
        if(posY < iscroll.maxScrollY) posY = iscroll.maxScrollY - offset2;

        iscroll.scrollTo(posX, posY, 0)
    }

}

FLIPBOOK.Book3.prototype.zoomTo = function(zoom, time, x, y) {

    if (!this.enabled) return;

    var x = x || 0
    var y = y || 0
    var time = time || 0
    this.zoom = zoom

    time = 0

    var scroll = this.scroll
    if (scroll) {
        // this.disablePan()
        scroll.zoom(zoom * this.ratio, x, y, time);

        // setTimeout(function(){
        //     scroll.enable()
        // },300)

    }
}

FLIPBOOK.Book3.prototype.setWrapperW = function(w) {
    if (this.$wrapperW != w) {
        this.$wrapper.width(w)
        this.$wrapperW = w
    }
}

FLIPBOOK.Book3.prototype.updateBookPosition = function() {

    if (this.options.singlePageMode) {
        this.setWrapperW(this.pageWidth)

        this.$wrapper.width(this.pageWidth)
        if (this.scroll)
            this.scroll.refresh()
        this.view = 1
        this.focusRight()
        return
    }

    if (this.view == 1) {
        this.setWrapperW(this.pageWidth)
        // this.$wrapper.width(this.pageWidth)
        // .css('left',-this.ratio * this.pageWidth/2+'px')

        // this.scroll.scroller.offsetWidth = this.pageWidth
    } else {
        this.setWrapperW(2 * this.pageWidth)
        // this.$wrapper.width(2 * this.pageWidth)
        // .css('left','0')
        // this.scroll.scroller.offsetWidth = 2*this.pageWidth
    }
    if (this.scroll)
        this.scroll.refresh()

    // this.scroll.scrollTo(0,0,0)
    // this.$wrapper.width(2 * this.pageWidth)

    var transform
    var pos
    if (this.view == 2) {
        if (this.isCover()) {
            this.focusRight()
        } else if (this.isBackCover()) {
            this.focusLeft()
        } else {
            this.focusBoth()
        }
    } else if (this.view == 1) {
        if (this.isCover()) {
            this.focusRight()
        } else if (this.isBackCover()) {
            this.focusLeft()
        } else {

        }
    }

}

FLIPBOOK.Book3.prototype.focusLeft = function(time, delay) {

    var pos = this.view == 1 || this.options.singlePageMode ? 0 : this.pageWidth / 2

    this.setBookPosition(pos, time, delay)

};

FLIPBOOK.Book3.prototype.focusRight = function(time, delay) {

    var pos = this.view == 1 || this.options.singlePageMode ? -this.pageWidth : -this.pageWidth / 2

    this.setBookPosition(pos, time, delay)

};

FLIPBOOK.Book3.prototype.focusBoth = function(time, delay) {

    var pos = this.view == 1 ? -this.pageWidth / 2 : 0

    this.setBookPosition(pos, time, delay)

};

FLIPBOOK.Book3.prototype.setBookPosition = function(pos, time, delay) {

    if (this.centerContainerPosition == pos)
        return
    var start = this.centerContainerPosition

    // var transform = 'translateX(' + pos + 'px) translateZ(0)'

    if (time) {

        // var nextEnabled = this.nextEnabled
        // var prevEnabled = this.prevEnabled

        // this.nextEnabled = false
        // this.prevEnabled = false

        var self = this
        delay = delay || 0

        jQuery({
            someValue: start
        }).delay(delay).animate({
            someValue: pos
        }, {
            duration: time,
            // easing: "easeInOutQuad", 
            // easing: "easeInOutCubic", 
            easing: this.flipEasing,
            // easing: "easeInQuad", 
            step: function(now) {
                self._setStyle(self.centerContainerStyle, FLIPBOOK.IScroll.utils.style.transform, 'translateX(' + now + 'px) translateZ(0)')
            },
            complete: function() {
                self.centerContainerPosition = pos
                // self.nextEnabled = nextEnabled
                // self.prevEnabled = prevEnabled
                self.updateFlipped()
                self.options.main.turnPageComplete()
            }
        });


    } else {
        var transform = 'translateX(' + pos + 'px)'
        this.centerContainerPosition = pos
        this._setStyle(this.centerContainerStyle, FLIPBOOK.IScroll.utils.style.transform, transform)
        this.updateFlipped()
        this.options.main.turnPageComplete()
    }
}


FLIPBOOK.Book3.prototype.updateVisiblePages = function(loadNextPrev) {

    if (typeof loadNextPrev == 'undefined')
        loadNextPrev = true
    var self = this
    var transform = FLIPBOOK.IScroll.utils.style.transform

    var index = this.rightIndex
    if(this.options.oddPages && this.options.rightToLeft) index--;
    /*if(this.options.rightToLeft)
        ri = this.options.pages.length - ri*/
    for (var i = 0; i < this.pagesArr.length; i++) {
        /*if (i == this.flippedleft * 2)
            this.pagesArr[i].show()
        else if (i == (this.flippedleft * 2 - 1) && !this.options.singlePageMode)
            this.pagesArr[i].show()
        else
            this.pagesArr[i].hide()*/
        if(i == index || (i == (index - 1) && !this.options.singlePageMode)){
            this.pagesArr[i].show()
        }else{
            this.pagesArr[i].hide()
        }

        this.pagesArr[i]._setZIndex(0)
        this.pagesArr[i]._setStyle(this.pagesArr[i].wrapper.style, transform, '');
    }
    this.updateBookPosition()

    

    var right = this.pagesArr[index]
    var left = this.pagesArr[index - 1]
    var next = this.pagesArr[index + 1]
    var afterNext = this.pagesArr[index + 2]
    var prev = this.pagesArr[index - 2]
    var beforePrev = this.pagesArr[index - 3]

    if (left) {
        self.options.main.setLoadingProgress(.1)
        left.load(function() {

            self.options.main.setLoadingProgress(1)
            left.showHtml()
            if (right) {
                right.load(function() {
                    self.options.main.setLoadingProgress(1)
                    if (prev) prev.load()
                    if (beforePrev) beforePrev.load()
                    if (next) next.load()
                    if (afterNext) afterNext.load()
                    right.showHtml()
                })
            } else {
                if (prev) prev.load()
                if (beforePrev) beforePrev.load()
            }

        })
    } else {
        self.options.main.setLoadingProgress(.1)
        right.load(function() {
            self.options.main.setLoadingProgress(1)
            if (next) next.load()
            if (afterNext) afterNext.load()
            right.showHtml()
        })
    }

    var xPos = this.options.rightToLeft ? -this.model.bookW : 0
    this.scroll.scrollTo(xPos, 0, 300)
}


FLIPBOOK.Book3.prototype.enable = function() {
    this.onResize()
    this.enabled = true
}

FLIPBOOK.Book3.prototype.disable = function() {
    this.onResize()
    this.enabled = false
}

FLIPBOOK.Book3.prototype.getLeftPage = function() {
    return this.pagesArr[this.flippedleft - 1]
}

FLIPBOOK.Book3.prototype.getRightPage = function() {
    return this.pagesArr[this.flippedleft]
}

FLIPBOOK.Book3.prototype.getLeftBackPage = function() {
    return this.pagesArr[this.flippedleft - 2]
}

FLIPBOOK.Book3.prototype.getRightBackPage = function() {
    return this.pagesArr[this.flippedleft + 1]
}

FLIPBOOK.Book3.prototype.getNextPage = function() {
    return this.pagesArr[this.flippedleft + 2]
}

FLIPBOOK.Book3.prototype.getPrevPage = function() {
    return this.pagesArr[this.flippedleft - 3]
}

FLIPBOOK.Book3.prototype.nextPage = function() {
    if (!this.nextEnabled) return

    if (this.view == 1 && this.isFocusedLeft() && !this.options.singlePageMode) {
        var duration = 700
        var d = this.options.pageFlipDuration * duration / 2
        this.focusRight(d);
        return
    }
    this.goToPage(this.rightIndex + 2)
}

FLIPBOOK.Book3.prototype.prevPage = function() {
    if (!this.prevEnabled) return

    if (this.view == 1 && this.isFocusedRight() && !this.options.singlePageMode) {
        var duration = 700
        var d = this.options.pageFlipDuration * duration / 2
        this.focusLeft(d);
        return
    }
    var target = this.options.singlePageMode ? this.rightIndex : this.rightIndex - 2;
    this.goToPage(target)
}

FLIPBOOK.Book3.prototype.goToPage = function(index, instant) {

    if (!this.enabled) return

    if (this.flipping)
        return;

    if (this.options.singlePageMode || index % 2 != 0) {
        index--;
    }

    if (index < 0)
        index = 0;

    if (index > this.options.pages.length)
        index = this.options.pages.length

    if (index == this.rightIndex) {
        //this.options.main.turnPageComplete()

        return;
    }
    if (instant || this.options.instantFlip) {
        this.setRightIndex(index)
        this.updateFlipped()
        this.updateVisiblePages()
        this.options.main.turnPageComplete()
        return;
    }

    this.flipping = true
    // var easing = "easeInOutQuad"
    // var easing = "easeInOutCubic"
    var easing = this.flipEasing
    // var easing = "easeInCubic"
    // var easing = "easeInOutSine"
    if (typeof jQuery.easing[easing] == 'undefined') {
        this.options.main.initEasing()
    }

    var duration = 700
    var d = this.options.pageFlipDuration * duration

    if (!this.options.singlePageMode) {

        if (this.view == 1) {
            if (index < this.rightIndex)
                this.focusRight(d)
            else
                this.focusLeft(d)
        } else {
            if (index == 0)
                this.focusRight(d)
            else if (index == this.pagesArr.length)
                this.focusLeft(d)
            else
                this.focusBoth(d)

        }
    }

    //if(this.singlePage)
    var self = this
    this.goingToPage = index
    //if(this.options.singlePageMode) this.goingToPage /= 2

    if (index > this.rightIndex) {
        end = 180
        if (self.angle <= 0 || self.angle >= 180 || !self.angle) self.angle = 1
    } else if (index < this.rightIndex) {
        end = -180
        if (self.angle >= 0 || self.angle <= -180 || !self.angle)
            self.angle = -1
    }
    // d *= Math.abs(end - this.angle) / 180
    if (this.options.singlePageMode)
        d /= 2;
    jQuery({
        someValue: self.angle
    }).animate({
        someValue: end
    }, {
        duration: d,
        easing: easing, // can be anything
        step: function(now) {
            self._setPageAngle(now)
        },
        complete: function() {
            self.setRightIndex(self.goingToPage)
            self.angle = 0
            self.flipping = false

            self.updateFlipped()
            self.updateVisiblePages()
            self.options.main.turnPageComplete()
        }
    });



    self.options.main.playFlipSound()
}

FLIPBOOK.Book3.prototype.updateFlipped = function(){

    this.flippedleft =  (this.rightIndex + this.rightIndex % 2) / 2
    this.flippedright = this.options.pages.length / 2 - this.flippedleft

}

FLIPBOOK.Book3.prototype.onSwipe = function(event, phase, direction, distance, duration, fingerCount, fingerData) {
    if (this.isZoomed())
        return;
    if (event.target.className == "flipbook-page-link")
        return;
    // if (jQuery(event.target).parents().hasClass('flipbook-page-htmlContent'))
    //     return;
    if (phase == 'start')
        return;
    if (direction == 'up' || direction == 'down')
        return


    // out because distance is already calculated correctly
    // distance = fingerData[0].start.x - fingerData[0].end.x

    if (this.flipping)
        return

    if (direction == "right")
        distance *= -1;

    // console.log(direction)
    var angle = distance * 180 / this.model.wrapperW
    if (phase == 'cancel' && fingerCount <= 1) {

        if (angle > 0)
            this.nextPage()
        else if (angle < 0)
            this.prevPage()
    }

    if (phase == 'end' && fingerCount <= 1) {
        if (angle > 0)
            this.nextPage()
        else if (angle < 0)
            this.prevPage()
    }

    if (phase == 'move' && fingerCount <= 1) {
        if (angle > 0) {
            if (!this.nextEnabled)
                return
            if (this.options.singlePageMode) {
                if (this.rightIndex == (this.pagesArr.length - 1))
                    return
            }
            this.goingToPage = this.options.singlePageMode ? this.rightIndex + 1 : this.rightIndex + 2
        } else if (angle < 0) {
            if (!this.prevEnabled)
                return
            this.goingToPage = this.options.singlePageMode ? this.rightIndex - 1 : this.rightIndex - 2
        }
        if (this.goingToPage != this.rightIndex && this.goingToPage >= 0 && this.goingToPage <= this.pagesArr.length)
            if(!this.options.instantFlip)
                this._setPageAngle(angle)

    }

}

FLIPBOOK.Book3.prototype.hideHtml = function(style, name, value) {

    for (i = 0; i < this.pagesArr.length; i++) {
        this.pagesArr[i].hideHtml()
    }

}

FLIPBOOK.Book3.prototype._setStyle = function(style, name, value) {
    // console.log(value)

    if (style) {
        // console.log(name)
        // console.log(value)
        style[name] = value
    }

}

FLIPBOOK.Book3.prototype._setPageAngle = function(angle) {

    var prev, next, front, back
    this.angle = angle
    this.hideHtml()
    
    if (this.options.singlePageMode) {
        if (angle > 0) {
            front = this.pagesArr[this.rightIndex]
            front._setAngle(angle / 2)
            next = this.pagesArr[this.goingToPage]
            // front.shadow.style.opacity = (angle - 30) / 900
            if (next) {
                next.show()
                // next.shadow.style.opacity = 1 - (angle) / 90
            }
        } else {
            back = this.pagesArr[this.goingToPage]
            back.show()
            back._setAngle(angle / 2 + 90)
            // back.shadow.style.opacity = (180 + angle - 30) / 900
            front = this.pagesArr[this.rightIndex]
            // front.shadow.style.opacity = 1 - (180 + angle) / 90
        }
        return;
    }

    // console.log(angle)

    var ri = this.rightIndex
    var ri2 = this.goingToPage
    if(this.options.rightToLeft && this.options.oddPages) {
        ri --;
        ri2 --;
    }

    if (angle > 0) {
        if (this.view == 1 && this.isFocusedLeft())
            return
        //flipping from right to left
        // angle 0 -> 180
        front = this.pagesArr[ri]
        back = this.pagesArr[ri2 - 1]
        this.applyAngles(front, back, angle, 90, 0)
        next = this.pagesArr[ri2]

        front.setShadowOpacity((angle - 10) / 600)
        back.setShadowOpacity((180 - angle - 10) / 600)
        // front.shadow.style.opacity = (angle - 10) / 600
        // back.shadow.style.opacity = (180 - angle - 10) / 600

        // console.log(angle)
        if (next) {
            next.show()
            // next.shadow.style.opacity = 1 - angle * 3 / 180
            // next.shadow.style.opacity = (90-angle) / 200
        }
        // prev = this.pagesArr[this.goingToPage - 3]
        // console.log(angle)
        // if(prev)
        //     prev.shadow.style.opacity = (angle - 90) / 200

        /*  var transform = FLIPBOOK.IScroll.utils.style.transform
          var pos
          var progress = angle / 180

          if (this.isCover())
              pos = -this.pageWidth / 2 + progress * this.options.pageWidth / 2

          if (this.view == 1 || !next)
              pos = progress * this.options.pageWidth / 2

          this.setBookPosition(pos)*/
        // if (newX)
        // this._setStyle(this.centerContainerStyle, transform, 'translateX(' + newX + 'px)')


    } else {
        if (this.view == 1 && this.isFocusedRight())
            return
        //flipping from left to right 
        //angle 0 -> -180
        
        back = this.pagesArr[ri - 1]
        front = this.pagesArr[ri2]
        this.applyAngles(front, back, angle, -90, 180)

        // back.shadow.style.opacity = (-angle - 10) / 600
        // front.shadow.style.opacity = (180 + angle - 10) / 600

        front.setShadowOpacity((180 + angle - 10) / 600)
        back.setShadowOpacity((-angle - 10) / 600)

        prev = this.pagesArr[ri2 - 1]
        // console.log(angle)
        if (prev) {
            prev.show()
            // prev.shadow.style.opacity = 1 - (180 + angle ) / 90
            // prev.shadow.style.opacity = (90+angle) / 200
        }
        // next = this.pagesArr[this.goingToPage + 2]
        // if(next)
        //     next.shadow.style.opacity = (-angle-90) / 200
        /*    var transform = FLIPBOOK.IScroll.utils.style.transform
                var pos
                var progress = -angle / 180
                if (this.isBackCover())
                    pos = this.pageWidth / 2 - progress * this.pageWidth / 2

                if (!prev)
                    pos = -progress * this.pageWidth / 2

                if (this.view == 1)
                    pos = -this.pageWidth - progress * this.pageWidth

                if (pos)
                    this.setBookPosition(pos)*/
    }

    // console.log(angle)

    // if (prev) {
    //         prev.$shadow.css('opacity', 1+angle / 180)
    //     }
    //     if (next) {
    //         next.$shadow.css('opacity', 1-angle / 180)
    //     }
    // console.log(front,back,angle)
}

FLIPBOOK.Book3.prototype.isCover = function() {
    return this.rightIndex == 0
}

FLIPBOOK.Book3.prototype.isBackCover = function() {
    return this.rightIndex == this.options.pages.length
}


FLIPBOOK.Book3.prototype.applyAngles = function(front, back, angle, x, y) {

    if (angle < x) {
        if (front) {
            front.show()
            front._setAngle(angle + y)
        }
        if (back) {
            back.hide()
            back._setAngle(45)
        }
    } else {
        if (back) {
            back.show()
            back._setAngle(angle + y)
        }
        if (front) {
            front.hide()
            front._setAngle(45)
        }
    }
}

FLIPBOOK.Book3.prototype.onPageUnloaded = function(index, size) {

    var pageIndex = index

    if (this.options.rightToLeft)
        pageIndex = this.options.pages.length - index - 1

    if(this.pagesArr[pageIndex]) 
        this.pagesArr[pageIndex].unload()

}

FLIPBOOK.Book3.prototype.onResize = function() {

    var model = this.model,
        w = model.wrapperW,
        h = model.wrapperH,
        bw = model.bookW,
        bh = model.bookH,
        pw = model.pageW,
        ph = model.pageH,
        r1 = w / h,
        r2 = pw / ph

    var main = this.options.main
    var options = this.options

    var self = this

    function fitToHeight() {
        // console.log('fit to height')

        self.ratio = h / bh;
        fit();

    }

    function fitToWidth() {
        // console.log('fit to width')

        self.ratio = self.view == 1 ? w / pw : w / bw;
        fit();

    }

    function fit() {

        if (self.scroll)
            self.scroll.options.zoomMin = self.ratio * options.zoomMin;
        if (self.scroll)
            self.scroll.options.zoomMax = self.ratio * options.zoomMax;

        self.updateBookPosition()
        if (self.scroll)
            self.scroll.zoom(self.ratio * options.main.zoom, w / 2, h / 2, 0);

    }

    var s = Math.min(this.zoom, 1)

    var zoomMin = Number(this.options.zoomMin)

    // var sp = 1

    if (!this.options.singlePageMode && this.options.responsiveView && w <= this.options.responsiveViewTreshold && r1 < 2 * r2) {

        this.view = 1

        if (w / h > pw / ph)
            fitToHeight();
        else
            fitToWidth();


    } else {

        this.view = 2

        if (w / h >= bw / bh)
            fitToHeight();
        else
            fitToWidth();


    }

    this.updateBookPosition()
    this.updateFlipped()
    this.options.main.turnPageComplete()

};

FLIPBOOK.Book3.prototype.isFocusedRight = function() {

    var center = this.view == 1 ? -this.pageWidth / 2 : 0
    if(this.options.singlePageMode) 
        return this.rightIndex % 2 == 0;
    else 
        return this.centerContainerPosition < center

}

FLIPBOOK.Book3.prototype.isFocusedLeft = function() {

    var center = this.view == 1 ? -this.pageWidth / 2 : 0

    if(this.options.singlePageMode) 
        return this.rightIndex % 2 == 1;
    else 
        return this.centerContainerPosition > center

}


FLIPBOOK.Page3 = function(book, index, texture, html) {

    this.book = book
    this.options = book.options
    this.texture = texture
    this.html = html
    this.index = index
    this.$wrapper = jQuery('<div>').addClass('flipbook-page3').width(book.options.pageWidth).height(book.options.pageHeight)
    this.wrapper = this.$wrapper[0]

    this.htmlContentScale = this.book.$wrapper.height() / 1000

    var options = book.options

    this.$inner = jQuery('<div>').appendTo(this.$wrapper).addClass('flipbook-page3-inner')
    this.$bg = jQuery('<div>').appendTo(this.$inner).addClass('flipbook-page3-bg')
    this.$html = jQuery('<div>').appendTo(this.$inner).addClass('flipbook-page3-html').addClass('page_'+index)

    this.$shadow = jQuery('<div>')
        .appendTo(this.$wrapper)
        .addClass('flipbook-page3-shadow')

    if (options.pagePreloader)
        this.$preloader = jQuery('<img src="' + options.pagePreloader + '" class="flipbook-page-preloader-image">').appendTo(this.$wrapper)
    else
        this.$preloader = jQuery('<img src="' + options.assets.spinner + '" class="flipbook-page-preloader">').appendTo(this.$wrapper)

    this.shadow = this.$shadow[0]
    this.hidden = false
    this.hide()
    this.zIndex = 0

    if( this.options.rightToLeft && this.options.oddPages )
        index ++;
    if (this.options.singlePageMode) {
        // this.$wrapper.addClass('flipbook-page3-front')
        this.$wrapper.css('left', String(this.book.options.pageWidth - 1) + 'px').addClass('flipbook-page3-front')
        this.type = "front"
    } else if (index % 2 == 0) {
        this.$wrapper.css('left', String(this.book.options.pageWidth - 1) + 'px').addClass('flipbook-page3-front')
        this.type = "front"
    } else {
        this.$wrapper.addClass('flipbook-page3-back')
        this.type = 'back'
    }


}

FLIPBOOK.Page3.prototype = {

    load: function(callback) {
        if (this.loaded == true) {
            if (callback) callback.call(this)
            return
        }

        this.loaded = true;

        var self = this

        var index = self.options.rightToLeft ? this.book.pagesArr.length - this.index - 1 : this.index;

        this.options.main.loadPageHTML(index, function(c) {

            //if (h && (!self.options.doublePage || self.index == 0 || self.index % 2 != 0)) {
            if(c){
                self.$html.empty().append(jQuery(c))
                // jQuery(c).appendTo(self.$html)

                // jQuery('<div>ttt</div>').appendTo(self.$html)
                // jQuery(document.body).append(jQuery(c))
                self.$html[0].style.transform = 'scale(' + self.htmlContentScale + ') translateZ(0)'
            }

            if (self.options.doublePage) {

                if (self.index % 2 == 0 && self.index > 0)
                    self.$html[0].style.left = '-100%'
                // else
                //     self.$html[0].style.left = '0'

            }

            if (self.hidden)
                self.hideHtml()

        })

        this.options.main.loadPage(index, this.options.pageTextureSize, function(page) {

            if(page.image){

                // var img = document.createElement('img')
                // img.src = page.image.src

                var img = page.image

                var imgW = page.image.naturalHeight
                var imgH = page.image.naturalHeight
                var pw = self.options.pageWidth
                var ph = self.options.pageHeight
                var scaleY = ph / imgH
                var translateX = 0

                if(self.options.pages[page.index].side == 'left' || self.options.pages[page.index].side == 'right'){
                    if(self.index % 2 == 0)
                        jQuery(img).css(FLIPBOOK.IScroll.utils.style.transform, 'translateX(-50%) translateZ(0)')

                }

                self.$bg.empty().append(jQuery(img));

                self.$preloader.hide()

              
            }

            if(page.canvas && self.pageSize != page.size){

                self.pageSize = page.size
                self.$bg.empty();

                if (self.options.doublePage && self.index % 2 == 0 && self.index != 0) {
                    jQuery(page.rCanvas).appendTo(self.$bg)
                } else if(self.options.doublePage && self.index % 2 == 1 && self.index != (self.options.pages.length - 1)){
                    jQuery(page.lCanvas).appendTo(self.$bg)
                } else
                    jQuery(page.canvas).appendTo(self.$bg)

                self.$preloader.hide()

            }

            if (callback) callback.call(self)

        })

    },

    unload: function() {

        this.loaded = false
        this.mat = false
        this.pageSize = null
        // this.$wrapper.css('background', '#eee')

    },

    setMat: function(c, h, front) {

        

    },

    hideHtml: function() {

        if (this.$html && !this.htmlHidden) {
            this.$html.hide()
            // console.log("hide html "+this.index)
        }
        this.htmlHidden = true
    },

    showHtml: function() {
        if (this.$html && this.htmlHidden) {
            this.$html.show()
            // console.log("show html "+this.index)
        }
        this.htmlHidden = false
    },

    setDataUrl: function(dataUrl, h) {

        var self = this

        this.$img.attr('src', dataUrl)
        this.$img[0].onload = function() {
            self.$wrapper.css({ 'background': 'none' })

        }
        if (self.html)
            jQuery(self.html).appendTo(self.$inner)

    },

    show: function() {
        if (this.hidden) {
            this.$wrapper[0].style.display = 'block'
            // this.shadow.style.opacity = '0'
            this.setShadowOpacity(0)

            // console.log("show "+this.index)
        }
        this.hidden = false
    },

    setShadowOpacity: function(val) {
        this.shadow.style.opacity = val
    },

    hide: function() {
        if (!this.hidden) {
            this.$wrapper[0].style.display = 'none'
            // this.shadow.style.opacity = '0'
            this.setShadowOpacity(0)

            // console.log("hide "+this.index)
        }

        this.hidden = true


    },

    _setScale: function(value) {
        if (this.scale != value) {
            var transform = FLIPBOOK.IScroll.utils.style.transform
            var transformStyle = 'scaleX(' + String(value) + ') translateZ(0)'
            this.scale = value
            this._setStyle(transform, transformStyle)
        }
    },

    _setAngle: function(angle) {

        if (this.angle == angle) return;
        this.angle = angle
        var transform = FLIPBOOK.IScroll.utils.style.transform
        var transformStyle
        var suffix = 'translateZ(0)'
        if (this.book.options.viewMode == "3d") {
            if (this.type == 'front') {
                transformStyle = 'rotateY(' + String(-angle) + 'deg) ' + suffix
            } else {
                transformStyle = 'rotateY(' + String(180 - angle) + 'deg) ' + suffix
            }
        } else if (this.book.options.viewMode == "2d") {
            if (this.type == 'front') {
                if (angle > 90) angle = 90
                transformStyle = 'scaleX(' + String((180 - 2 * angle) / 180) + ') ' + suffix
            } else {
                if (angle < 90) angle = 90
                transformStyle = 'scaleX(' + String(-1 + (2 * angle) / 180) + ') ' + suffix
            }
        }

        this._setStyle(this.wrapper.style, transform, transformStyle);
        var i
        var max = 0;
        for (i = 0; i < this.book.pagesArr.length; i++) {
            if (i != this.index && this.book.pagesArr[i].zIndex > max)
                max = this.book.pagesArr[i].zIndex
        }
        this._setZIndex(max + 1);
    },

    _setZIndex: function(val) {
        if (this.zIndex != val)
            this.wrapper.style['z-index'] = val
        this.zIndex = val
    },

    _setStyle: function(style, name, value) {

        if (style)
            style[name] = value
    }

}