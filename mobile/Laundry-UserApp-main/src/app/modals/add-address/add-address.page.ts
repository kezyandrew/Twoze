import { Component, ElementRef, OnInit, ViewChild } from "@angular/core";
import { AndroidPermissions } from "@ionic-native/android-permissions/ngx";
import { Geolocation } from "@ionic-native/geolocation/ngx";
import { LocationAccuracy } from "@ionic-native/location-accuracy/ngx";
import { ModalController, Platform } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";
declare var google: any;
@Component({
  selector: "app-add-address",
  templateUrl: "./add-address.page.html",
  styleUrls: ["./add-address.page.scss"],
})
export class AddAddressPage implements OnInit {
  @ViewChild("map", { static: false }) mapElement: ElementRef;
  map: any;
  latt: number;
  long: number;
  printAddress: any;
  addr1: string = "";
  label: string = "";
  err: any;
  locationCoords: any;
  constructor(
    private geolocation: Geolocation,
    private modal: ModalController,
    private api: ApiService,
    private util: UtilService,
    private androidPermissions: AndroidPermissions,
    private locationAccuracy: LocationAccuracy,
    private platform:Platform
  ) {
    this.locationCoords = {
      latitude: "",
      longitude: "",
      accuracy: "",
      timestamp: "",
    };
  }
  isAdd: boolean = true;

  ngOnInit() {
    
  }


  detect() {
    this.androidPermissions
      .checkPermission(
        this.androidPermissions.PERMISSION.ACCESS_COARSE_LOCATION
      )
      .then(
        (result) => {
          if (result.hasPermission) {
            this.askToTurnOnGPS();
          } else {
            this.requestGPSPermission();
          }
        },
        (err) => {
          
        }
      );
  }

  requestGPSPermission() {
    this.locationAccuracy.canRequest().then((canRequest: boolean) => {
      if (canRequest) {
      } else {
        this.androidPermissions
          .requestPermission(
            this.androidPermissions.PERMISSION.ACCESS_COARSE_LOCATION
          )
          .then(
            () => {
              this.askToTurnOnGPS();
            },
            (error) => {
              
            }
          );
      }
    });
  }

  askToTurnOnGPS() {
    this.locationAccuracy
      .request(this.locationAccuracy.REQUEST_PRIORITY_HIGH_ACCURACY)
      .then(
        () => {
          this.getLocationCoordinates();
        },
        (error) =>
          alert(
            "Error requesting location permissions " + JSON.stringify(error)
          )
      );
  }
  getLocationCoordinates() {
    this.util.startLoad();
    this.geolocation.getCurrentPosition().then((result) => {
      this.loadMap(result.coords.latitude, result.coords.longitude);
      this.latt = result.coords.latitude;
      this.long = result.coords.longitude;
      this.util.presentToast("Location Detected......");
      this.util.dismissLoader();
    });
  }
  ionViewWillEnter() {
    this.platform.ready().then(() => {
      this.initPage();
    })
  }
  initPage() {

    this.util.startLoad();
    this.geolocation.getCurrentPosition().then(result => {
      this.loadMap(result.coords.latitude, result.coords.longitude); 
      
      
      this.latt = result.coords.latitude;
      this.long = result.coords.longitude;
      
      
    });
    
  }
  loadMap(lat, lng) {
    let latLng = new google.maps.LatLng(parseFloat(lat), parseFloat(lng));
    let mapOption = {
      center: latLng,
      zoom: 14,
      mapTypeId: 'roadmap',
      disableDefaultUI: true
    }
    let element = document.getElementById('map');
    this.map = new google.maps.Map(element, mapOption);
    let marker = new google.maps.Marker(
      {
        map: this.map,
        draggable: true,
        animation: google.maps.Animation.DROP,
        position: this.map.getCenter()
      });
    let content = `
          <div id="myId" class="item item-thumbnail-left item-text-wrap">
            <ion-item>
              <ion-row>
                <h6> `+ marker.title + `</h6>
                <h6> `+ marker.position + `</h6>
              </ion-row>
            </ion-item>
          </div>
        `
    this.addInfoWindow(marker, content);
    marker.setMap(this.map);
  }
  addInfoWindow(marker, content) {
    
    {
      let infoWindow = new google.maps.InfoWindow(
        {
          content: content
        });
      google.maps.event.addListener(marker, 'click', () => {
        infoWindow.open(this.map, marker);
      });
      var geocoder = new google.maps.Geocoder();

      google.maps.event.addListener(marker, 'dragend', function () {
        this.markerlatlong = marker.getPosition();    
        this.latt = marker.getPosition().lat(); 
        this.long = marker.getPosition().lng();
      
       localStorage.setItem('marketLat',marker.getPosition().lat())
       localStorage.setItem('marketLng',marker.getPosition().lng())
        
     
        geocoder.geocode({
          'latLng':  this.markerlatlong
        }, function (results, status) {
          if (status ==
              google.maps.GeocoderStatus.OK) {
              if (results[1]) {           
                  
                  this.zipcode = results[1].zipcode;
              } else {  
              }
          } else {
              
             
          }
      });
      });
    }
  }
  isAddAddress: boolean = true;


  addAddress() {
    this.util.startLoad();
    this.isAddAddress = false;

    let data = {
      addr1: this.addr1,
      label: this.label,
      lat: localStorage.getItem('marketLat') ? localStorage.getItem('marketLat') : this.latt,
      long: localStorage.getItem('marketLng') ? localStorage.getItem('marketLng') : this.long
    };
    this.api.postDataWithToken("add_address", data).subscribe(
      (success: any) => {
        if (success.success) {
          this.util.presentToast("Address Adddd Succesfully");
          localStorage.removeItem('markerLat');
          localStorage.removeItem('markerLng');
          localStorage.setItem('SelectAddress',this.addr1);
          this.isAdd = false;
          this.modal.dismiss(success.data);
          this.util.dismissLoader();
        }
      },
      (err) => {
        this.err = err.error.errors;
      }
    );
  }
}
