import { Component, OnInit } from "@angular/core";
import { ApiService } from "src/app/api.service";
import { UtilService } from "src/app/util.service";

@Component({
  selector: "app-terms",
  templateUrl: "./terms.page.html",
  styleUrls: ["./terms.page.scss"],
})
export class TermsPage implements OnInit {
  terms: any;

  constructor(private api: ApiService, private util: UtilService) {}

  ngOnInit() {
    this.util.startLoad();
    this.api.getData("settings").subscribe(
      (success: any) => {
        if (success.success) {
          this.terms = success.data.terms_of_use;
          this.util.dismissLoader();
        }
      },
      (err) => {
        this.util.dismissLoader();
      }
    );
  }
}
