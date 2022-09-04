import { Component, OnInit } from '@angular/core';
import { ActionSheetController } from '@ionic/angular';
import { ApiService } from 'src/app/api.service';
import { UtilService } from 'src/app/util.service';
import { countryCode } from 'src/environments/environment';
import { Camera } from '@ionic-native/camera/ngx';
@Component({
  selector: 'app-edit-profile',
  templateUrl: './edit-profile.page.html',
  styleUrls: ['./edit-profile.page.scss'],
})
export class EditProfilePage implements OnInit {
  code :any;
  cCode: any = countryCode;
  profile: any;
  codeChange:any;
  image: string;
  imagePreview: any;
  isImgChange: boolean;
  name:any;
  email:any;
  phone:any;
  constructor(private camera:Camera,private sheetCtrl:ActionSheetController,private api:ApiService,private util:UtilService) { }

  ngOnInit() {
    this.util.startLoad();
    this.api.getDataWithToken('profile').subscribe((success:any) => {
      this.profile = success.data;
      this.code = success.data.code;
      this.image = this.profile.imagePath + this.profile.image;
      this.util.setNewprofile(true);
      this.util.dismissLoader();
    }, err => {
      this.util.dismissLoader();
    })
  }

  changeProfile(){
    this.util.startLoad();
    let data = {
      code:this.code,
      email:this.email,
      phone:this.phone,
      name:this.name
    }
    this.api.postDataWithToken('profile_edit',data).subscribe((success:any) => {
      if(success.success){
        this.util.presentToast('profile has successfully changed');
        this.util.navCtrl.navigateForward('tabs/profile');
        this.util.setNewLogin(true);
        this.util.newLogin.next(true);
        this.util.setNewprofile(true);
        this.util.dismissLoader();
      }
    }, err =>{
      this.util.dismissLoader();
    })
  }
  back(){
    this.util.navCtrl.back();
  }

  async albumSheet() {
    const actionSheet = await this.sheetCtrl.create({
      header: 'Albums',
      mode: 'ios',
      cssClass: 'image-picker', 
      buttons: [{
        text: 'Gallery',
        icon: 'images-sharp',
        handler: () => {
          this.getGallery();
        }
      }, {
        text: 'Camera',
        icon: 'camera-sharp',
        handler: () => {
          this.getCamera();
        }
      }, {
        text: 'Cancel',
        icon: 'close',
        role: 'cancel',
        handler: () => {
        }
      }]
    });
    await actionSheet.present();
  }
  

  public getCamera():any {
    this.camera.getPicture({
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      correctOrientation: true
    }).then(file_uri => {
      this.image = "data:image/jpg;base64," + file_uri;
      this.imagePreview = file_uri
      this.isImgChange = true;
      let data = {
        image:this.imagePreview
      }
      this.api.postDataWithToken('profile_edit_image',data).subscribe((success:any) => {  
        if(success.success){
          this.util.presentToast('Image has successfuly Changed')
        }
      }, err => {
        this.util.presentToast('Something Went Wrong');
      })
    });
  }

  public getGallery():any {
    this.camera.getPicture({ 
      sourceType: this.camera.PictureSourceType.PHOTOLIBRARY,
      destinationType: this.camera.DestinationType.DATA_URL,
      encodingType: this.camera.EncodingType.JPEG,
      correctOrientation: true,
    }).then(file_uri => {
      this.image = "data:image/jpg;base64," + file_uri;
      this.isImgChange = true;
      this.imagePreview = file_uri
      let data = {
        image:this.imagePreview
      }
      this.api.postDataWithToken('profile_edit_image',data).subscribe((success:any) => {
        if(success.success){
          this.util.presentToast('Image has successfuly Changed')
        }
      }, err => {
        this.util.presentToast('Something went wrong');
      })
    });
  }

}
