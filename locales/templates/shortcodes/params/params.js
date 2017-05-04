!function($) {

	this.ttGMap = function() {
		this.initLocation = { lat: 38.20365531807149, lng: -98.26171875 };
		this.mapBox = document.getElementById( 'tt-vc-map' );
		this.mapSearch = document.getElementById( 'tt-search-map' );
		this.removeMarkers = document.getElementById( 'tt-remove-markers' );
		this.labels = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ';
		this.labelIndex = 0;
		this.markers = [];

		this.mapOutput = {};
		this.mapOutput.markers = [];

		this.init();
	}

	ttGMap.prototype.init = function() {
		 this.map = new google.maps.Map( this.mapBox, {
			zoom: 4,
			center: this.initLocation
		} );

		this.addMarker = function( location, map ) {
			var marker = new google.maps.Marker({
				position: location,
				label: this.labels[this.labelIndex++ % this.labels.length],
				draggable: true,
				map: map
			});
			this.markers.push( marker );
			marker = {
				lat: location.lat(),
				lng: location.lng(),
				label: marker.label
			};
			this.mapOutput.markers.push( marker );
		};

		this.searchBox = new google.maps.places.SearchBox( this.mapSearch );
		this.map.controls[google.maps.ControlPosition.TOP_LEFT].push( this.mapSearch );
		this.map.controls[google.maps.ControlPosition.TOP_LEFT].push( this.removeMarkers );

		ttGMapEvents.call( this );
		ttSavedOptions.call( this );
	};

	function ttGMapEvents() {
		var _this = this;

		this.map.addListener( 'bounds_changed', function() {
			_this.searchBox.setBounds( _this.map.getBounds() );
		} );

		this.searchBox.addListener( 'places_changed', function() {
			var places = _this.searchBox.getPlaces();
			var bounds = new google.maps.LatLngBounds();

			places.forEach( function( place ) {
				if( place.geometry.viewport ) {
					bounds.union( place.geometry.viewport );
				} else {
					bounds.extend( place.geometry.location );
				}
			} );

			_this.map.fitBounds( bounds );
		} );



		google.maps.event.addListener( this.map, 'click', function( event ) {
			_this.addMarker( event.latLng, _this.map );
		} );

		this.map.addListener( 'mouseout', function() {
			_this.mapOutput.zoom = _this.map.getZoom();
			_this.mapOutput.location = {};
			_this.mapOutput.location.lat = _this.map.center.lat();
			_this.mapOutput.location.lng = _this.map.center.lng();

			var mapData = JSON.stringify( _this.mapOutput );
			$( '.tt_map_settings' ).val( btoa( mapData ) );
		} );

		this.removeMarkers.addEventListener( 'click', function( e ) {
			e.preventDefault();

			for (var i = 0; i < _this.markers.length; i++) {
				_this.markers[i].setMap( null );
			}

			_this.markers = [];
			_this.mapOutput.markers = [];
		} );
	}

	function ttSavedOptions() {
		var savedObj = $( '.tt_map_settings' ).val();
		var _this = this;
		
		try {
			savedObj = JSON.parse( atob( savedObj ) );
		} catch(e) {
			return;
		}

		if( typeof savedObj === 'object' ) {

			this.map.setCenter( savedObj.location );
			this.map.setZoom( savedObj.zoom )

			savedObj.markers.forEach( function( marker ) {
				var defaultMarker = new google.maps.Marker( {
					position: {
						lat: marker.lat,
						lng: marker.lng
					},
					label: marker.label,
					draggable: true,
					map: _this.map
				} );

				_this.markers.push( defaultMarker );
				defaultMarker = {
					lat: marker.lat,
					lng: marker.lng,
					label: marker.label
				};

				_this.mapOutput.markers.push( defaultMarker );
			} );
		}
	}

	var index = 0;

	$('.vc_edit-form-tab-control').click(function(e) {
		if( $(this).find('button').text() === 'Map Editor' && index === 0 ) {
			setTimeout( function() {
				var test = new ttGMap();
			}, 300 );
			index = 1;
		}
	});

}(jQuery);