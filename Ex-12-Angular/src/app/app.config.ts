// app.config.ts
import { NgModule } from '@angular/core';
import { BrowserModule } from '@angular/platform-browser';
import { RouterModule } from '@angular/router';
import { FormsModule } from '@angular/forms';  // <-- Import FormsModule
import { AppComponent } from './app.component';
import { HomeComponent } from './home/home.component';
import { AboutComponent } from './about/about.component';
import { ContactComponent } from './contact/contact.component';
import { appRoutes } from './app.routes';  // Import the routes from app.routes.ts

@NgModule({
  declarations: [
    AppComponent,
    HomeComponent,
    AboutComponent,
    ContactComponent,
  ],
  imports: [
    BrowserModule,
    FormsModule,   // <-- Add FormsModule to the imports array
    RouterModule.forRoot(appRoutes),  // Set up routes using the RouterModule
  ],
  providers: [],
  bootstrap: [AppComponent],
})
export class AppConfig { }
