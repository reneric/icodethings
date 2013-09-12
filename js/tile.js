/*!
jQuery wookmark plugin
@name jquery.wookmark.js
@author Christoph Ono (chri@sto.ph or @gbks)
@author Sebastian Helzle (sebastian@helzle.net or @sebobo)
@version 1.2.3
@date 06/14/2013
@category jQuery plugin
@copyright (c) 2009-2013 Christoph Ono (www.wookmark.com)
@license Licensed under the MIT (http://www.opensource.org/licenses/mit-license.php) license.
*/
(function(t){"function"==typeof define&&define.amd?define(["jquery"],t):t(jQuery)})(function(t){var e,s,h;h=function(t,i){return function(){return t.apply(i,arguments)}},s={align:"center",container:t("body"),offset:2,autoResize:!1,itemWidth:0,flexibleWidth:0,resizeDelay:50,onLayoutChanged:void 0},e=function(){function e(i,e){this.handler=i,this.columns=this.containerWidth=this.resizeTimer=null,this.activeItemCount=0,this.direction="left",this.itemHeightsDirty=!0,t.extend(!0,this,s,e),this.update=h(this.update,this),this.onResize=h(this.onResize,this),this.onRefresh=h(this.onRefresh,this),this.getItemWidth=h(this.getItemWidth,this),this.layout=h(this.layout,this),this.layoutFull=h(this.layoutFull,this),this.layoutColumns=h(this.layoutColumns,this),this.filter=h(this.filter,this),this.clear=h(this.clear,this),this.getActiveItems=h(this.getActiveItems,this);for(var o,n=j=0,r={};i.length>n;n++)if($item=i.eq(n),o=$item.data("filterClass"),"object"==typeof o&&o.length>0)for(j=0;o.length>j;j++)filterClass=t.trim(o[j]).toLowerCase(),filterClass in r||(r[filterClass]=[]),r[filterClass].push($item[0]);this.filterClasses=r,this.autoResize&&t(window).bind("resize.wookmark",this.onResize),this.container.bind("refreshWookmark",this.onRefresh)}return e.prototype.update=function(i){this.itemHeightsDirty=!0,t.extend(!0,this,i)},e.prototype.onResize=function(){clearTimeout(this.resizeTimer),this.itemHeightsDirty=0!=this.flexibleWidth,this.resizeTimer=setTimeout(this.layout,this.resizeDelay)},e.prototype.onRefresh=function(){this.itemHeightsDirty=!0,this.layout()},e.prototype.filter=function(i,e){var s,h,o,n,r,a=[],l=t();if(i=i||[],e=e||"or",i.length){for(h=0;i.length>h;h++)r=t.trim(i[h].toLowerCase()),r in this.filterClasses&&a.push(this.filterClasses[r]);if(s=a.length,"or"==e||1==s)for(h=0;s>h;h++)l=l.add(a[h]);else if("and"==e){var u,f,m,d=a[0],c=!0;for(h=1;s>h;h++)a[h].length<d.length&&(d=a[h]);for(h=0;d.length>h;h++){for(f=d[h],c=!0,o=0;a.length>o&&c;o++)if(m=a[o],d!=m){for(n=0,u=!1;m.length>n&&!u;n++)u=m[n]==f;c&=u}c&&l.push(d[h])}}this.handler.not(l).addClass("inactive")}else l=this.handler;l.removeClass("inactive"),this.columns=null,this.layout()},e.prototype.getActiveItems=function(){return this.handler.not(".inactive")},e.prototype.getItemWidth=function(){var t=this.itemWidth,i=this.container.width(),e=this.handler.eq(0),s=this.flexibleWidth;if(void 0===this.itemWidth||0===this.itemWidth&&!this.flexibleWidth?t=e.outerWidth():"string"==typeof this.itemWidth&&this.itemWidth.indexOf("%")>=0&&(t=parseFloat(this.itemWidth)/100*i),s){"string"==typeof s&&s.indexOf("%")>=0&&(s=parseFloat(s)/100*i-e.outerWidth()+e.innerWidth());var h=~~(1+i/(s+this.offset)),o=(i-(h-1)*this.offset)/h;t=Math.max(t,~~o),this.handler.css("width",t)}return t},e.prototype.layout=function(){if(this.container.is(":visible")){var t,e=this.getItemWidth()+this.offset,s=this.container.width(),h=~~((s+this.offset)/e),o=maxHeight=i=0,n=this.getActiveItems(),r=n.length;if(this.itemHeightsDirty){for(;r>i;i++)t=n.eq(i),t.data("outerHeight",t.outerHeight());this.itemHeightsDirty=!1}h=Math.max(1,Math.min(h,r)),o="left"==this.align||"right"==this.align?~~(h/e+this.offset>>1):~~(.5+(s-(h*e-this.offset))>>1),this.direction="right"==this.align?"right":"left",maxHeight=null!=this.columns&&this.columns.length==h&&this.activeItemCount==r?this.layoutColumns(e,o):this.layoutFull(e,h,o),this.activeItemCount=r,this.container.css("height",maxHeight),void 0!==this.onLayoutChanged&&"function"==typeof this.onLayoutChanged&&this.onLayoutChanged()}},e.prototype.layoutFull=function(t,i,e){var s,h=0,o=0,n=this.getActiveItems(),r=n.length,a=null,l=null,u={position:"absolute"},f=[],m="left"==this.align?!0:!1;for(this.columns=[];i>f.length;)f.push(0),this.columns.push([]);for(;r>h;h++){for($item=n.eq(h),a=f[0],l=0,o=0;i>o;o++)a>f[o]&&(a=f[o],l=o);s=0==l&&m?0:l*t+e,u[this.direction]=s,u.top=a,$item.css(u),f[l]+=$item.data("outerHeight")+this.offset,this.columns[l].push($item)}return Math.max.apply(Math,f)},e.prototype.layoutColumns=function(t,i){for(var e,s,h,o=[],n=0,r=0;this.columns.length>n;n++)for(o.push(0),e=this.columns[n],h=n*t+i,r=0;e.length>r;r++)$item=e[r],s={top:o[n]},s[this.direction]=h,$item.css(s),o[n]+=$item.data("outerHeight")+this.offset;return Math.max.apply(Math,o)},e.prototype.clear=function(){clearTimeout(this.resizeTimer),t(window).unbind("resize.wookmark",this.onResize),this.container.unbind("refreshWookmark",this.onRefresh)},e}(),t.fn.wookmark=function(t){return this.wookmarkInstance?this.wookmarkInstance.update(t||{}):this.wookmarkInstance=new e(this,t||{}),this.wookmarkInstance.layout(),this.show()}});

/*!
 * imagesLoaded v3.0.2
 * JavaScript is all like "You images are done yet or what?"
 */

( function( window ) {

'use strict';

var $ = window.jQuery;
var console = window.console;
var hasConsole = typeof console !== 'undefined';

// -------------------------- helpers -------------------------- //

// extend objects
function extend( a, b ) {
  for ( var prop in b ) {
    a[ prop ] = b[ prop ];
  }
  return a;
}

var objToString = Object.prototype.toString;
function isArray( obj ) {
  return objToString.call( obj ) === '[object Array]';
}

// turn element or nodeList into an array
function makeArray( obj ) {
  var ary = [];
  if ( isArray( obj ) ) {
    // use object if already an array
    ary = obj;
  } else if ( typeof obj.length === 'number' ) {
    // convert nodeList to array
    for ( var i=0, len = obj.length; i < len; i++ ) {
      ary.push( obj[i] );
    }
  } else {
    // array of single index
    ary.push( obj );
  }
  return ary;
}

// --------------------------  -------------------------- //

function defineImagesLoaded( EventEmitter, eventie ) {

  /**
   * @param {Array, Element, NodeList, String} elem
   * @param {Object or Function} options - if function, use as callback
   * @param {Function} onAlways - callback function
   */
  function ImagesLoaded( elem, options, onAlways ) {
    // coerce ImagesLoaded() without new, to be new ImagesLoaded()
    if ( !( this instanceof ImagesLoaded ) ) {
      return new ImagesLoaded( elem, options );
    }
    // use elem as selector string
    if ( typeof elem === 'string' ) {
      elem = document.querySelectorAll( elem );
    }

    this.elements = makeArray( elem );
    this.options = extend( {}, this.options );

    if ( typeof options === 'function' ) {
      onAlways = options;
    } else {
      extend( this.options, options );
    }

    if ( onAlways ) {
      this.on( 'always', onAlways );
    }

    this.getImages();

    if ( $ ) {
      // add jQuery Deferred object
      this.jqDeferred = new $.Deferred();
    }

    // HACK check async to allow time to bind listeners
    var _this = this;
    setTimeout( function() {
      _this.check();
    });
  }

  ImagesLoaded.prototype = new EventEmitter();

  ImagesLoaded.prototype.options = {};

  ImagesLoaded.prototype.getImages = function() {
    this.images = [];

    // filter & find items if we have an item selector
    for ( var i=0, len = this.elements.length; i < len; i++ ) {
      var elem = this.elements[i];
      // filter siblings
      if ( elem.nodeName === 'IMG' ) {
        this.addImage( elem );
      }
      // find children
      var childElems = elem.querySelectorAll('img');
      // concat childElems to filterFound array
      for ( var j=0, jLen = childElems.length; j < jLen; j++ ) {
        var img = childElems[j];
        this.addImage( img );
      }
    }
  };

  /**
   * @param {Image} img
   */
  ImagesLoaded.prototype.addImage = function( img ) {
    var loadingImage = new LoadingImage( img );
    this.images.push( loadingImage );
  };

  ImagesLoaded.prototype.check = function() {
    var _this = this;
    var checkedCount = 0;
    var length = this.images.length;
    this.hasAnyBroken = false;
    // complete if no images
    if ( !length ) {
      this.complete();
      return;
    }

    function onConfirm( image, message ) {
      if ( _this.options.debug && hasConsole ) {
        console.log( 'confirm', image, message );
      }

      _this.progress( image );
      checkedCount++;
      if ( checkedCount === length ) {
        _this.complete();
      }
      return true; // bind once
    }

    for ( var i=0; i < length; i++ ) {
      var loadingImage = this.images[i];
      loadingImage.on( 'confirm', onConfirm );
      loadingImage.check();
    }
  };

  ImagesLoaded.prototype.progress = function( image ) {
    this.hasAnyBroken = this.hasAnyBroken || !image.isLoaded;
    this.emit( 'progress', this, image );
    if ( this.jqDeferred ) {
      this.jqDeferred.notify( this, image );
    }
  };

  ImagesLoaded.prototype.complete = function() {
    var eventName = this.hasAnyBroken ? 'fail' : 'done';
    this.isComplete = true;
    this.emit( eventName, this );
    this.emit( 'always', this );
    if ( this.jqDeferred ) {
      var jqMethod = this.hasAnyBroken ? 'reject' : 'resolve';
      this.jqDeferred[ jqMethod ]( this );
    }
  };

  // -------------------------- jquery -------------------------- //

  if ( $ ) {
    $.fn.imagesLoaded = function( options, callback ) {
      var instance = new ImagesLoaded( this, options, callback );
      return instance.jqDeferred.promise( $(this) );
    };
  }


  // --------------------------  -------------------------- //

  var cache = {};

  function LoadingImage( img ) {
    this.img = img;
  }

  LoadingImage.prototype = new EventEmitter();

  LoadingImage.prototype.check = function() {
    // first check cached any previous images that have same src
    var cached = cache[ this.img.src ];
    if ( cached ) {
      this.useCached( cached );
      return;
    }
    // add this to cache
    cache[ this.img.src ] = this;

    // If complete is true and browser supports natural sizes,
    // try to check for image status manually.
    if ( this.img.complete && this.img.naturalWidth !== undefined ) {
      // report based on naturalWidth
      this.confirm( this.img.naturalWidth !== 0, 'naturalWidth' );
      return;
    }

    // If none of the checks above matched, simulate loading on detached element.
    var proxyImage = this.proxyImage = new Image();
    eventie.bind( proxyImage, 'load', this );
    eventie.bind( proxyImage, 'error', this );
    proxyImage.src = this.img.src;
  };

  LoadingImage.prototype.useCached = function( cached ) {
    if ( cached.isConfirmed ) {
      this.confirm( cached.isLoaded, 'cached was confirmed' );
    } else {
      var _this = this;
      cached.on( 'confirm', function( image ) {
        _this.confirm( image.isLoaded, 'cache emitted confirmed' );
        return true; // bind once
      });
    }
  };

  LoadingImage.prototype.confirm = function( isLoaded, message ) {
    this.isConfirmed = true;
    this.isLoaded = isLoaded;
    this.emit( 'confirm', this, message );
  };

  // trigger specified handler for event type
  LoadingImage.prototype.handleEvent = function( event ) {
    var method = 'on' + event.type;
    if ( this[ method ] ) {
      this[ method ]( event );
    }
  };

  LoadingImage.prototype.onload = function() {
    this.confirm( true, 'onload' );
    this.unbindProxyEvents();
  };

  LoadingImage.prototype.onerror = function() {
    this.confirm( false, 'onerror' );
    this.unbindProxyEvents();
  };

  LoadingImage.prototype.unbindProxyEvents = function() {
    eventie.unbind( this.proxyImage, 'load', this );
    eventie.unbind( this.proxyImage, 'error', this );
  };

  // -----  ----- //

  return ImagesLoaded;
}

// -------------------------- transport -------------------------- //

if ( typeof define === 'function' && define.amd ) {
  // AMD
  define( [
      'eventEmitter',
      'eventie'
    ],
    defineImagesLoaded );
} else {
  // browser global
  window.imagesLoaded = defineImagesLoaded(
    window.EventEmitter,
    window.eventie
  );
}

})( window );
