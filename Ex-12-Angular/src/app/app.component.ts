import { Component } from '@angular/core';
import { HomeComponent } from './home/home.component';

@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.css']
})
export class AppComponent {
  contactInfo: string = '';

  updateContactInfo(info: string) {
    this.contactInfo = info;
  }
}



