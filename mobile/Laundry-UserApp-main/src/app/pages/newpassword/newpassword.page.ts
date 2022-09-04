import { Component, OnInit } from "@angular/core";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-newpassword",
  templateUrl: "./newpassword.page.html",
  styleUrls: ["./newpassword.page.scss"],
})
export class NewpasswordPage implements OnInit {
  password: string = "";
  confirm_password: string = "";
  constructor(private api: ApiService, private util: UtilService) {}
  public image: any = "";
  ngOnInit() {}

  ionViewWillEnter() {
    this.util.startLoad();
    this.api.getData("settings").subscribe(
      (success: any) => {
        if (success.success) {
          this.image = success.data.imagePath + success.data.splash_screen;

          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
      }
    );
  }

  changePassword() {
    this.util.startLoad();
    let data = {
      password: this.password,
      confirm_password: this.confirm_password,
      user_id: localStorage.getItem("verifyId"),
    };
    this.api.postDataWithToken("changePassword", data).subscribe(
      (success: any) => {
        if (success.success) {
          this.util.presentToast("Password Successfully Changed");
          this.util.navCtrl.navigateForward("login");
          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
      }
    );
  }
}
