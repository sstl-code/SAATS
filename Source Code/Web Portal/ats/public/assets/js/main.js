import Feature from '/ol/Feature.js';
import Geolocation from './ol/Geolocation.js';
import Map from './ol/Map.js';
import Point from './ol/geom/Point.js';
import View from './ol/View.js';
import {Circle as CircleStyle, Fill, Stroke, Style} from './ol/style.js';
import {OSM, Vector as VectorSource} from './ol/source.js';
import {Tile as TileLayer, Vector as VectorLayer} from './ol/layer.js';
import {fromLonLat} from './ol/proj';
const view = new View({
  center: [0, 0],
  zoom: 8,
});

const map = new Map({
  layers: [
    new TileLayer({
      source: new OSM(),
    }),
  ],
  target: 'map',
  view: view,
});


const geolocation = new Geolocation({
  // enableHighAccuracy must be set to true to have the heading value.
  trackingOptions: {
    enableHighAccuracy: true,
  },
  projection: view.getProjection(),
});

function el(id) {
  return document.getElementById(id);
}

el('track').addEventListener('change', function () {
  geolocation.setTracking(true);
});

// update the HTML page when the position changes.


// handle geolocation error.
geolocation.on('error', function (error) {
  const info = document.getElementById('info');
  info.innerHTML = error.message;
  info.style.display = '';
});

const accuracyFeature = new Feature();
geolocation.on('change:accuracyGeometry', function () {
  accuracyFeature.setGeometry(geolocation.getAccuracyGeometry());
});

const positionFeature = new Feature();
const positionFeature1=new Feature();
positionFeature.setStyle(
  new Style({
    image: new CircleStyle({
      radius: 6,
      fill: new Fill({
        color: '#3399CC',
      }),
      stroke: new Stroke({
        color: '#fff',
        width: 2,
      }),
    }),
  })
);
positionFeature1.setStyle(
  new Style({
    image: new CircleStyle({
      radius: 6,
      fill: new Fill({
        color: '#33CCCC',
      }),
      stroke: new Stroke({
        color: '#fff',
        width: 2,
      }),
    }),
  })
);
geolocation.on('change:position', function () {
  const coordinates = geolocation.getPosition();
  map.getView().setCenter(coordinates);
  positionFeature.setGeometry(coordinates ? new Point(coordinates) : null);

});
const coordinates1=fromLonLat([77.5946,12.9716]);
positionFeature1.setGeometry(coordinates1 ? new Point(coordinates1) : null);

new VectorLayer({
  map: map,
  source: new VectorSource({
    features: [accuracyFeature, positionFeature],
  }),
});
new VectorLayer({
  map: map,
  source: new VectorSource({
    features: [ positionFeature1],
  }),
});