<script>
var map;
var infowindow;


bh();
function initialize () {
    if (navigator.geolocation) {    
        //$('#status').text('Retrieving your location...');
        navigator.geolocation.getCurrentPosition(
            onSuccess,
            onError, {
            enableHighAccuracy: true,
            timeout: 20000,
            maximumAge: 120000
            });

    }

}

function onSuccess(position) {
  
    inits(position.coords.latitude, position.coords.longitude);
    codeLatLng(position.coords.latitude, position.coords.longitude);
    
  
}
function bh(){
  var bheight = screen.height;
  $('body').css('height',bheight);
}
$(window).resize(function(){
  var bheight = screen.height;
  $('body').css('height',bheight);
})
function codeLatLng(lat,lng) {
    var latlng = new google.maps.LatLng(lat, lng);
    geocoder.geocode({'latLng': latlng}, function(results, status) {
      if (status == google.maps.GeocoderStatus.OK) {
        if (results[3]) {
          inits(lat,lng,results[3].formatted_address);
        }
      }
    })
  }
function inits(lat,lng) {
  var latlng = new google.maps.LatLng(lat,lng);
geocoder = new google.maps.Geocoder();

  map = new google.maps.Map(document.getElementById('map-canvas'), {
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    center: latlng,
    zoom: 12
  });
var rad = 2000;
  var request = {
    location: latlng,
    radius: 6000,
    // openNow: true,
    types: ['food']
  };
var defaultBounds = new google.maps.LatLngBounds(
  new google.maps.LatLng(lat, lng),
  new google.maps.LatLng(lat,lng));

var input = document.getElementById('searchField');
var options = {
  bounds: defaultBounds,
  types: ['establishment']
};


autocomplete = new google.maps.places.Autocomplete(input, options);
service = new google.maps.places.PlacesService(map);
service.nearbySearch(request, callbacks);


}
  function callbacks(results, status) {
    if (status == google.maps.places.PlacesServiceStatus.OK) {
      for (var i = 0; i < results.length; i++) {
        callIt(results[i]);
      }
    }
  }

function callIt(place) {
  var requests = { reference: place.reference };
  service.getDetails(requests, function(details, status) {
    var d = new Date();
    var n = d.getDay(); 
    var content = place.name + ': ';
    var op = details.opening_hours.periods[n].open.time;
    if(op > 1200){
      op = op-1200;
      open = op.substring(0,1) + ':' + op.substring(1,3) + "pm";
    }else if(op == 0000){
      open = "24 Hours";
    }else if(op < 1000){
      m = op.substr(1, 4);
      open = m.substring(0,1) + ':' + m.substring(1,3) + "am";
    }else{
      open = op.substring(0,2) + ':' + op.substring(2,4) + "am";
    }
    content += open;
    var cl = details.opening_hours.periods[n].close.time;
    if(cl > 1200 && cl < 2200){
      i = (cl-1200);

      c = cl.substr(1, 3);

      //a = c.substring(0,1) + ':' + c.substring(1,3) + "pm";

      close = cl;
    }else if(cl == 0000){
      close = "";
    }else if(cl < 1000){
      c = cl.substr(1, 4);
      close = c.substring(0,1) + ':' + c.substring(2,4) + "am";
    }else{
      close = c.substring(0,2) + ':' + c.substring(2,4) + "am";
    }
    content += ' - ' + close;
    $('#places ul').append('<li>' + content + '</li>');
  });
}


$('a.getDirections').live('click',function(e){
  //e.preventDefault();
  $("#map-canvased").animate({
    height:"250px"
  })
  var start = $(this).parent().find('.start').val();
  var end = $(this).parent().find('.end').val();
  calcRoute(start,end)
})
function calcRoute(start,end) {
  var request = {
      origin:start,
      destination:end,
      travelMode: google.maps.DirectionsTravelMode.DRIVING
  };
  directionsService.route(request, function(response, status) {
    if (status == google.maps.DirectionsStatus.OK) {
      directionsDisplay.setDirections(response);
    }
  });
}
// function callback(results, status) {
//   if (status == google.maps.places.PlacesServiceStatus.OK) {
//     for (var i = 0; i < results.length; i++) {
//       createMarker(results[i]);
//     }
//   }
// }
// function createMarker(place) {
//   var placeLoc = place.geometry.location;
//   var marker = new google.maps.Marker({
//     map: map,
//     position: place.geometry.location
//   });

//   google.maps.event.addListener(marker, 'click', function() {
//     infowindow.setContent(place.name);
//     infowindow.open(map, this);
//   });
// }

google.maps.event.addDomListener(window, 'load', test); //create markers
var YWSID = "pQPI_tbhQOXN6K6CdQ7ovg";
$('a').live('click',function(){
var $this = $(this);
});
function spinner (){
var h = window.innerHeight;
  var w = window.innerWidth;
  var h2 = (h * 0.5) - 18;
  var w2 = (w * 0.5) - 18;
  $('#places img.loading').css('top', h2+"px").css('left', w2+"px");

}

function onError(err) {
    var message;
    switch (err.code) {
        case 0:
        message = 'Unknown error: ' + err.message;
        break;
        case 1:
        message = 'You denied permission to retrieve a position.';
        break;
        case 2:
        message = 'The browser was unable to determine a position: ' + error.message;
        break;
        case 3:
        message = 'The browser timed out before retrieving the position.';
        break;
    }
}
function yelp(addy){
        $('#status').text('Found you!');
//alert('hello')
 var auth = { 
  consumerKey: "cRMNBlwXnz5Yvz7YVgvYWA", 
  consumerSecret: "-HEDLRweP5OZIxxI55QibKUM658",
  accessToken: "5M9lWtICdWunRZxsjHFT_jV4xzkbn8jO",
  accessTokenSecret: "6kxwUiGVMWH7J4sfiZ44q0xSDHY",
  serviceProvider: { 
    signatureMethod: "HMAC-SHA1"
  }
};

// var terms = 'restaurant';
// var lati = lat + ', ' + lng + ', 2';
// var co = lat + ', ' + lng;
var addy = addy;


var accessor = {
  consumerSecret: auth.consumerSecret,
  tokenSecret: auth.accessTokenSecret
};

parameters = [];
parameters.push(['location', addy]);
// parameters.push(['ll', lati]);
// parameters.push(['term', terms]);
parameters.push(['callback', 'cb']);
parameters.push(['oauth_consumer_key', auth.consumerKey]);
parameters.push(['oauth_consumer_secret', auth.consumerSecret]);
parameters.push(['oauth_token', auth.accessToken]);
parameters.push(['oauth_signature_method', 'HMAC-SHA1']);

var message = { 
  'action': 'http://api.yelp.com/v2/search/',
  'method': 'GET',
  'parameters': parameters 
};

OAuth.setTimestampAndNonce(message);
OAuth.SignatureMethod.sign(message, accessor);

var parameterMap = OAuth.getParameterMap(message.parameters);
parameterMap.oauth_signature = OAuth.percentEncode(parameterMap.oauth_signature)
console.log(parameterMap);
$.when(
  $.ajax({
    'url': message.action,
    'data': parameterMap,
    'cache': true,
    'dataType': 'jsonp',
    'jsonpCallback': 'cb',
    'success': function(data, textStats, XMLHttpRequest) {

       display(data)
      } 
    })
).then( function(){
        var handler = null;
        var options = {
           autoResize: true,
           container: $('#tiles'), 
          offset: 5 
        };

        handler = $('#tiles li');

        // Call the layout function.
        handler.wookmark(options);
    });

};
function searchIt(lat,lng, search){
        $('#status').text('Found you!');
 var auth = { 
  consumerKey: "cRMNBlwXnz5Yvz7YVgvYWA", 
  consumerSecret: "-HEDLRweP5OZIxxI55QibKUM658",
  accessToken: "5M9lWtICdWunRZxsjHFT_jV4xzkbn8jO",
  accessTokenSecret: "6kxwUiGVMWH7J4sfiZ44q0xSDHY",
  serviceProvider: { 
    signatureMethod: "HMAC-SHA1"
  }
};
var terms = search;
var lati = lat + ', ' + lng + ', 2';
var co = lat + ', ' + lng;
var accessor = {
  consumerSecret: auth.consumerSecret,
  tokenSecret: auth.accessTokenSecret
};
parameters = [];
parameters.push(['ll', lati]);
parameters.push(['term', terms]);
parameters.push(['callback', 'cb']);
parameters.push(['oauth_consumer_key', auth.consumerKey]);
parameters.push(['oauth_consumer_secret', auth.consumerSecret]);
parameters.push(['oauth_token', auth.accessToken]);
parameters.push(['oauth_signature_method', 'HMAC-SHA1']);
var message = { 
  'action': 'http://api.yelp.com/v2/search/',
  'method': 'GET',
  'parameters': parameters 
};
OAuth.setTimestampAndNonce(message);
OAuth.SignatureMethod.sign(message, accessor);
var parameterMap = OAuth.getParameterMap(message.parameters);
parameterMap.oauth_signature = OAuth.percentEncode(parameterMap.oauth_signature)
console.log(parameterMap);
$.ajax({
  'url': message.action,
  'data': parameterMap,
  'cache': true,
  'dataType': 'jsonp',
  'jsonpCallback': 'cb',
  'success': function(data, textStats, XMLHttpRequest) {
   //  $('body').html(data)

 display(data, co, lat, lng)

    } 
  }); // display(data, co, lat, lng)
};//searchIt()
function checkDistance(lat,lng){
        $('#status').text('Found you!');
//alert('hello')
 var auth = { 
  //
  // Update with your auth tokens.
  //
  consumerKey: "cRMNBlwXnz5Yvz7YVgvYWA", 
  consumerSecret: "-HEDLRweP5OZIxxI55QibKUM658",
  accessToken: "5M9lWtICdWunRZxsjHFT_jV4xzkbn8jO",
  // This example is a proof of concept, for how to use the Yelp v2 API with javascript.
  // You wouldn't actually want to expose your access token secret like this in a real application.
  accessTokenSecret: "6kxwUiGVMWH7J4sfiZ44q0xSDHY",
  serviceProvider: { 
    signatureMethod: "HMAC-SHA1"
  }
};

var terms = 'restaurant';
// var near = 'baton+rouge';
var lati = lat + ', ' + lng + ', 2';
var co = lat + ', ' + lng;



var accessor = {
  consumerSecret: auth.consumerSecret,
  tokenSecret: auth.accessTokenSecret
};

parameters = [];
parameters.push(['ll', lati]);
parameters.push(['term', terms]);
parameters.push(['callback', 'cb']);
parameters.push(['oauth_consumer_key', auth.consumerKey]);
parameters.push(['oauth_consumer_secret', auth.consumerSecret]);
parameters.push(['oauth_token', auth.accessToken]);
parameters.push(['oauth_signature_method', 'HMAC-SHA1']);

var message = { 
  'action': 'http://api.yelp.com/v2/search/',
  'method': 'GET',
  'parameters': parameters 
};

OAuth.setTimestampAndNonce(message);
OAuth.SignatureMethod.sign(message, accessor);

var parameterMap = OAuth.getParameterMap(message.parameters);
parameterMap.oauth_signature = OAuth.percentEncode(parameterMap.oauth_signature)
console.log(parameterMap);

$.ajax({
  'url': message.action,
  'data': parameterMap,
  'cache': true,
  'dataType': 'jsonp',
  'jsonpCallback': 'cb',
  'success': function(data, textStats, XMLHttpRequest) {
   //  $('body').html(data)

 checkIt(data)

    } 
  }); //checkIt(data)
};//checkDistance
function reviews(data, co){
  document.getElementById('places').innerHTML = '';
  $('#sort-options').append('<span class="up">Categories</span>');
 $('#status').slideUp();
 $('#sort-options').css('visibility','visible');
 document.getElementById('places').className = '';
 var hasReviews;
  for (var i = 0; i < data.businesses.length; i++) {
  hasReviews = data.businesses[i].review_count;
  dist = data.businesses[i].distance;
 var auth = { 
  consumerKey: "cRMNBlwXnz5Yvz7YVgvYWA", 
  consumerSecret: "-HEDLRweP5OZIxxI55QibKUM658",
  accessToken: "5M9lWtICdWunRZxsjHFT_jV4xzkbn8jO",
  accessTokenSecret: "6kxwUiGVMWH7J4sfiZ44q0xSDHY",
  serviceProvider: { 
    signatureMethod: "HMAC-SHA1"
  }
};
var accessor = {
  consumerSecret: auth.consumerSecret,
  tokenSecret: auth.accessTokenSecret
};
parameters = [];
parameters.push(['ll', co]);
parameters.push(['callback', 'cb']);
parameters.push(['oauth_consumer_key', auth.consumerKey]);
parameters.push(['oauth_consumer_secret', auth.consumerSecret]);
parameters.push(['oauth_token', auth.accessToken]);
parameters.push(['oauth_signature_method', 'HMAC-SHA1']);
var message = { 
  'action': 'http://api.yelp.com/v2/business/' + data.businesses[i].id,
  'method': 'GET',
  'parameters': parameters 
};
OAuth.setTimestampAndNonce(message);
OAuth.SignatureMethod.sign(message, accessor);
var parameterMap = OAuth.getParameterMap(message.parameters);
parameterMap.oauth_signature = OAuth.percentEncode(parameterMap.oauth_signature)
console.log(parameterMap);
  $.ajax({
    'url': message.action,
    'data': parameterMap,
    'cache': true,
    'dataType': 'jsonp',
    'jsonpCallback': 'cb',
    'success': function(data, textStats, XMLHttpRequest) {
        showData(data, co);   
      }
    });
  }; //showData(data)
};

function distance(lat1,lon1,lat2,lon2) {
  var R = 6371; // Radius of the earth in km
  var dLat = deg2rad(lat2-lat1);  // deg2rad below
  var dLon = deg2rad(lon2-lon1); 
  var a = 
    Math.sin(dLat/2) * Math.sin(dLat/2) +
    Math.cos(deg2rad(lat1)) * Math.cos(deg2rad(lat2)) * 
    Math.sin(dLon/2) * Math.sin(dLon/2)
    ; 
  var c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a)); 
  var d = R * c; // Distance in km
  return d;
}
function miles(dist){
  var m = dist * 1000;
  var miles = m * 0.000621371192;
  return miles;
}
function metersToMiles(dist){
  var miles = dist * 0.000621371192;
  return miles;
}
function deg2rad(deg) {
  return deg * (Math.PI/180)
}
function loc(lt,lg){
  this.lt = lt;
  this.lg = lg;
}
function test(l1,l2,l3,l4){
  return l1+','+l2+','+l3+','+l4;
}
var id, target, options, i;
i = 0;
var lastloc = new loc(0,0);
var okdist = 0.5;
var showMe = 0.2;
function success(pos) {
var lat = pos.coords.latitude;
var lon = pos.coords.longitude;
var newPos = new loc(lat,lon);
var moved = distance(lastloc.lt, lastloc.lg, newPos.lt,newPos.lg);
var mi = miles(moved);
if (mi > okdist) {
    lastloc = newPos;
    checkDistance(lat,lon)
    //alert(moved)
    //alert('You have moved '+mi+' miles!');
    var savedArray = JSON.parse($("input#myArray").val());
    var result = savedArray.indexOf("Jack In the Box");
    if(result > -1 && i < 1){
      //alert('Found it Jack!')
      i = 1;
    }
    }
    var mySpeed = pos.coords.speed * 2.2369;
    speed = Math.round(mySpeed);
  $('#watchMe h1 span').text(speed)
}
function error(err) {
console.log('error');
};
options = {
  enableHighAccuracy: true,
  maximumAge        : 30000,
  timeout           : 27000
};
navigator.geolocation.watchPosition(success, error, options);
$("#search").live('submit',function(e){
  e.preventDefault();
  
  document.getElementById('places').innerHTML = '';
  $('#places').append('<ul></ul>');
  $('#search')
  navigator.geolocation.getCurrentPosition(searched);
  return false;
}) // All speed / watch position code
function searched(position){
  var term = $('#searchField').val();
   searchIt(position.coords.latitude,position.coords.longitude, term);
   return false;
}
function checkIt(data){
  $.each(data.businesses, function(i,business){
    var lat = business.location.coordinate.latitude;
    var lng = business.location.coordinate.longitude;
    var meters = business.distance;
    var d = metersToMiles(meters)
    if(d < showMe){
      $('#watchMe ul').append('<li>'+business.name+'</li>');
    }
  });
}
function display(data){


var arr = [];
var len = data.businesses.length;

for (var i = 0; i < len; i++) {

    var obj = data.businesses[i].name
    arr.push(obj);
    $('#places ul').append('<li>' + data.businesses[i].name + '</li>');
}
$("input#myArray").val(JSON.stringify(arr));
// for (var i = 0; i < len; i++) {
//     var business = data.businesses[i];
//     $('#status').fadeOut(); 
//     var cat = '';
//     var img = '';
//     var distance = '';
//     var ratingHtml = '';
//     var miles = '';
//     var sum = '';
//     var phone = '';
//     var sMap;
//     var string = '';
//     var addy = '';
//     var cit = '';
//     var coord = '';
//     if(business.distance) {
//       miles = (business.distance) * 0.000621371192;
//       distance = Math.round( miles * 100 ) / 100;
//     }
//     if(business.image_url) {
//       img += business.image_url;
//     }else{
//       img += "img/place.png";
//     }
//     $.each(business.categories, function(i,category){
//         cat = category[0];
//     });

//     $.each(business.location.address, function(i,loc){
//             addy = loc;
//     });
//     $.each(business.location.city, function(i,cities){
//             cit += cities;
//     });
//     $.each(business.location.coordinate, function(i,cLoc){
//             coord = cLoc;

//     });
//     if (business.rating) {
//       for (var r = 0; r < 5; r++) {
//         var i = business.rating;
//         if (business.rating < (r + 0.5)) {
//           ratingHtml += '&#10025;';
//         } else {
//           ratingHtml += '&#10029;';
//         }
//       }
//     }else{
//       ratingHtml += '<span class="clearfix no-rating">Not yet rated</span>';
//     }
//     if(business.phone) {
//         string = business.phone;
//         phone = string.substring(0,0) + '(' + string.substring(0,3) + ') ' + string.substring(3,6) + '-' + string.substring(6,10);
//     }
//     var lat = business.location.coordinate.latitude;
//     var lng = business.location.coordinate.longitude;
//     var sort = cat.replace(/\s+/g, '-').toLowerCase();
//     var content = '<li class="clearfix visible tile ' + sort + '">';
//         content += '<h1 class="titles">' + business.name + '</h1>'
//         content += '<div class="clearfix top"><span class="category">' + cat + '</span>';
//         content += '<div class="clearfix distance">' + distance + ' miles</div></div>';
//         content += '<div class="clearfix sMap">';
//         content += '<img src="http://maps.googleapis.com/maps/api/staticmap?center=' + lat + ',' + lng + '&';
//         content += 'zoom=17&markers=size:mid|' + lat + ',' + lng + '&size=330x150&scale=2&visual_refresh=true&maptype=ROADMAP&sensor=false"/></div>';
//         //content += '<img src="http://maps.googleapis.com/maps/api/streetview?size=300x146&location=' + lat + ',' + lng + '&fov=90&heading=235&pitch=10&sensor=false">';
//         content += '<div class="clearfix rating">' + ratingHtml + '<span> Rating: ' + business.rating + '/5</span></div>';
//         content += '<a class="viewDetails" href="#">View Details</a>';
//         content += '<div class="details"><div class="clearfix addy">' + addy + ', ' + cit + '</div>';
//         content += '<div class="bottom"><div class="clearfix phone"><a href="tel:' + business.display_phone + '"><span>Call</span> ' + phone + '</a></div>';
//         content += '<div class="clearfix website"><a target="_blank" href="' + business.url + '">Yelp</a></div></div></div>';
//         content += '<a href="#map-canvas" class="getDirections">Directions</a><div class="clearfix directions">';
//         //content += '<input class="start" type="hidden" value="'+co+'" /><input class="end" type="hidden" value="'+lat+','+lng+'" /></div>'; 
//         content += '<span class="close" data-filter-value=".visible">x</span></li>';
//         $('#places ul').append(content)
//         $('#sort-options ul').each(function() {
//           var seen = {};
//           $(this).children('li').each(function() {
//             var txt = $(this).text();
//             if (seen[txt])
//               $(this).remove();
//             else
//               seen[txt] = true;
//             });
//           });
//       };
        var ht = $('#places').height();
          $('.viewDetails').toggle(function(){
            $(this).text('Hide Details').next('.details').slideDown();
          },function(){
            $(this).text('View Details').next('.details').slideUp();
          })
        $('.viewReviews').toggle(function(){
          // $('.reviews').hide();
          $(this).next('.reviews').slideDown();
        },function(){
          $(this).next('.reviews').slideUp();
        })



}
function re_init() {
   $('#status').fadeIn();

   document.getElementById('places').innerHTML = '<img class="loading" src="img/spinner.png"/>';
   spinner();
   var ref = 'refresh';
   initializeRefresh();
}
function showData(business, co) {
            var cat = '';
            var img = '';
            var distance = '';
            var ratingHtml = '';
            var miles = '';
            var sum = '';
            var phone = '';
            var sMap;
            var string = '';
            var addy = '';
            var cit = '';
            var coord = '';
            if(business.distance) {
              miles = (business.distance) * 0.000621371192;
              distance = Math.round( miles * 100 ) / 100;
            }
            if(business.image_url) {
              img += business.image_url;
            }else{
              img += "img/place.png";
            }
            $.each(business.categories, function(i,category){
                cat = category[0];
            });

            $.each(business.location.address, function(i,loc){
                    addy = loc;
            });
            $.each(business.location.city, function(i,cities){
                    cit += cities;
            });
            $.each(business.location.coordinate, function(i,cLoc){
                    coord = cLoc;
          
            });
             $.each(business.location.coordinate, function(i,cLoc){
                    coord = cLoc;
          
            });
            $.each(business.reviews, function(i,rev){
                 sum += '<div class="clearfix review"><div class="excerpt">' + rev.excerpt + '</div>';
                 sum += '<span class="user">' + rev.user.name + '</span></div>';
          
            });
            if (business.rating) {
              for (var r = 0; r < 5; r++) {
                var i = business.rating;
                if (business.rating < (r + 0.5)) {
                  ratingHtml += '&#10025;';
                } else {
                  ratingHtml += '&#10029;';
                }
              }
            }else{
              ratingHtml += '<span class="clearfix no-rating">Not yet rated</span>';
            }
            if(business.phone) {
                string = business.phone;
                phone = string.substring(0,0) + '(' + string.substring(0,3) + ') ' + string.substring(3,6) + '-' + string.substring(6,10);

            }
            var lat = business.location.coordinate.latitude;
            var lng = business.location.coordinate.longitude;
            var sort = cat.replace(/\s+/g, '-').toLowerCase();
            var content = '<div class="clearfix visible tile ' + sort + '">';
                content += '<h1 class="titles">' + business.name + '</h1>';
                content += '<div class="clearfix top"><span class="category">' + cat + '</span>';
                content += '<div class="clearfix distance">' + distance + ' miles</div></div>';
                content += '<div class="clearfix sMap"><img src="http://maps.googleapis.com/maps/api/staticmap?center=' + lat + ',' + lng + '&zoom=15&markers=size:mid|' + lat + ',' + lng + '&size=330x150&scale=2&visual_refresh=true&maptype=ROADMAP&sensor=false"/></div>';
                content += '<div class="clearfix rating">' + ratingHtml + '<span> Rating: ' + business.rating + '/5</span></div>';
                content += '<a class="viewDetails" href="#">View Details</a>';
                content += '<div class="details"><div class="clearfix addy">' + addy + ', ' + cit + '</div>';
                content += '<div class="bottom"><div class="clearfix phone"><a href="tel:' + business.display_phone + '"><span>Call</span> ' + phone + '</a></div>';
                content += '<div class="clearfix website"><a target="_blank" href="' + business.url + '">Yelp</a></div></div></div>';
                content += '<div class="clearfix directions"><a href="#map-canvas" class="getDirections">Directions</a><input class="start" type="hidden" value="'+co+'" /><input class="end" type="hidden" value="'+lat+','+lng+'" /></div>'; 
                content += '<span class="close" data-filter-value=".visible">x</span></div>';
            $('#places').append(content);
$('#sort-options ul').each(function() {
            var seen = {};
            $(this).children('li').each(function() {
              var txt = $(this).text();
              if (seen[txt])
                $(this).remove();
              else
                seen[txt] = true;
              });
            });    
var ht = $('#places').height();
$('.viewDetails').toggle(function(){
                $(this).text('Hide Details').next('.details').slideDown();
              },function(){
                $(this).text('View Details').next('.details').slideUp();
            })
$('.viewReviews').toggle(function(){
          $(this).text('Hide Reviews');
          $(this).next('.reviews').slideDown();
      

        },function(){
          count = $(this).attr('rel');
          $(this).text(count + ' Reviews');
          $(this).next('.reviews').slideUp();
        })
sorting(data);


}
function sorting(data){

  $('#sort-options').append('<ul>');
  $('#sort-options ul').append('<li data-filter-value="*">All</li>');
  var choice;
  var txt;
  var sort;

  $.each(data.businesses, function(i,business){
    if(business.categories){
      $.each(business.categories, function(i,category){
          choice = category[0]
          sort = choice.replace(/\s+/g, '-').toLowerCase();
      });
     var sCat = '<li data-filter-value=".' + sort + '">' + choice + '</li>';
       $('#sort-options ul').append(sCat);

    }
  document.getElementById('sort-options').className = '';
  $('#sort-options').fadeIn().append('</ul>');
  })


  var $container = $('#places'),
filters = {};
$container.imagesLoaded( function(){ //Solves Chrome images issue
$container.isotope({
itemSelector : '.tile'
});
// filter buttons
$('#sort-options ul li').click(function(){
var $this = $(this);
var text = $this.text();
$this.parent().slideUp();
$this.parent().parent().find('span').removeClass('down').addClass('up').text(text);
// don't proceed if already selected
if ( $this.hasClass('selected') ) {
return;
}
var $optionSet = $this.parents('#sort-options ul');
// change selected class
$optionSet.find('.selected').removeClass('selected');
$this.addClass('selected');
// store filter value in object
// i.e. filters.color = 'red'
var group = $optionSet.attr('data-filter-group');
filters[ group ] = $this.attr('data-filter-value');
// convert object into array
var isoFilters = [];
for ( var prop in filters ) {
isoFilters.push( filters[ prop ] )
}
var selector = isoFilters.join('');
$container.isotope({ filter: selector });
return false;
});

}); 


  var $wrap = $('#places'),
filters = {};
$wrap.imagesLoaded( function(){ //Solves Chrome images issue
$wrap.isotope({
itemSelector : '.tile'
});
$('.tile .close').click(function(){
var $this = $(this);
var $optionSet = $this.parent().parent();//.parents('#places');
$this.parent().addClass('closed');
$optionSet.find('.closed').removeClass('visible');
$this.addClass('hidden');
var group = $optionSet.attr('data-filter-group');
filters[ group ] = $this.attr('data-filter-value');
// convert object into array
var isoFilters = [];
for ( var prop in filters ) {
isoFilters.push( filters[ prop ] )
}
var selector = isoFilters.join('');
$wrap.isotope({ filter: selector });
return false;
});
});
}
</script>