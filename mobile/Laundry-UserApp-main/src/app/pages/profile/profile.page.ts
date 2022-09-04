import { Component, OnInit } from "@angular/core";
import { Camera } from "@ionic-native/camera/ngx";
import { ActionSheetController, ModalController } from "@ionic/angular";
import { ViewerModalComponent } from "ngx-ionic-image-viewer";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";
import { LoginPage } from "../login/login.page";
@Component({
  selector: "app-profile",
  templateUrl: "./profile.page.html",
  styleUrls: ["./profile.page.scss"],
})
export class ProfilePage implements OnInit {
  isImgChange: boolean;
  imagePreview: any;
  profile: any;
  data: any;
  constructor(
    private camera: Camera,
    private sheetCtrl: ActionSheetController,
    private api: ApiService,
    private util: UtilService,
    private modalController: ModalController
  ) {}
  ngOnInit() {
    this.getProfile();
    this.util.editProfile.subscribe((res) => {
      this.getProfile();
    });
  }

  getProfile() {
    this.api.getDataWithToken("profile").subscribe(
      (success: any) => {
        if (success.success) {
          this.profile = success.data;
          this.util.dismissLoader();
        }
      },
      (err) => {}
    );
  }

  ionViewDidEnter() {}

  async ionViewWillEnter() {
    this.util.startLoad();
    let token = localStorage.getItem("token")
      ? localStorage.getItem("token")
      : "";
    if (token == "") {
      localStorage.setItem("previous-request", "true");
      localStorage.setItem("previous-request-page", "/tabs/profile");
      let modal = await this.modalController.create({
        component: LoginPage,
      });
      modal.onDidDismiss().then((res) => {
        this.util.startLoad();
        this.api.getDataWithToken("profile").subscribe(
          (success: any) => {
            if (success.success) {
              this.util.setNewLogin(true);
              this.profile = success.data;
              this.util.dismissLoader();
            }
          },
          (err) => {}
        );

        this.api.getData("settings").subscribe(
          (success: any) => {
            if (success.success) {
              this.data = success.data;
            }
          },
          (err) => {}
        );
      });
      return await modal.present();
    }

    let hasPre = localStorage.getItem("previous-request")
      ? localStorage.getItem("previous-request")
      : false;
    let prePage = localStorage.getItem("previous-request-page")
      ? localStorage.getItem("previous-request-page")
      : "";
    if (hasPre == "true" && prePage == "select-time-slot") {
      localStorage.setItem("previous-request", "true");
    }

    this.api.getDataWithToken("profile").subscribe(
      (success: any) => {
        if (success.success) {
          this.util.setNewLogin(true);
          this.util.newLogin.next(true);
          this.profile = success.data;
          this.util.dismissLoader();
        }
      },
      (err) => {}
    );

    this.api.getData("settings").subscribe(
      (success: any) => {
        if (success.success) {
          this.data = success.data;
        }
      },
      (err) => {}
    );
  }

  profilego() {
    this.util.navCtrl.navigateForward("edit-profile");
  }

  logout() {
    this.util.navCtrl.navigateForward("login");
    localStorage.clear();
  }

  async openViewer() {
    const modal = await this.modalController.create({
      component: ViewerModalComponent,
      componentProps: {
        src: this.profile.imagePath + this.profile.image,
      },
      cssClass: "ion-img-viewer",
      keyboardClose: true,
      showBackdrop: true,
    });

    return await modal.present();
  }
  public image: any = "../../../assets/image/Ellipse 14.png";
}
