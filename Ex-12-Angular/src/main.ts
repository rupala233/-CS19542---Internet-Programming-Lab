import { platformBrowserDynamic } from '@angular/platform-browser-dynamic';  // Importing platformBrowserDynamic
import { AppConfig } from './app/app.config';  // Importing AppConfig

platformBrowserDynamic().bootstrapModule(AppConfig)
  .catch((err: any) => console.error(err));  // Explicitly typing 'err' as 'any'

