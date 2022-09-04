import { Component, OnInit } from "@angular/core";
import { NavController } from "@ionic/angular";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-verify",
  templateUrl: "./verify.page.html",
  styleUrls: ["./verify.page.scss"],
})
export class VerifyPage implements OnInit {
  email: string = "";
  err: any;
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
      (err) => {}
    );
  }

  verify() {
    this.util.startLoad();
    let data = {
      email: this.email,
    };
    this.api.postDataWithToken("sendOtp", data).subscribe(
      (success: any) => {
        if (success.success) {
          this.util.navCtrl.navigateForward("otp");
          localStorage.setItem("verifyId", success.data.id);
          localStorage.setItem("isFrom", "verify");
          this.util.dismissLoader();
        }
      },
      (err) => {
        this.err = err.error.errors;
        this.util.dismissLoader();
      }
    );
  }
}
