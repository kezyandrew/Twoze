import { Component, OnInit } from '@angular/core';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';

@Component({
  selector: 'app-privacy',
  templateUrl: './privacy.page.html',
  styleUrls: ['./privacy.page.scss'],
})
export class PrivacyPage implements OnInit {
  privacy: any;

  constructor(private api:ApiService,private util:UtilService) { }

  ngOnInit() {
    this.util.startLoad();
    this.api.getData('settings').subscribe((success:any) => {
      if(success.success){
        this.privacy = success.data.terms_of_use
        this.util.dismissLoader();
      }
    }, err => {
      this.util.dismissLoader();
    })
  }

}
