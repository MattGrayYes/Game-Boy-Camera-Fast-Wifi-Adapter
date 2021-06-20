
# Game Boy Camera Wifi Photo Extractor
I’ve had my Game Boy Camera since the ‘90s: it was my first digital camera, and I love it.
I worked out a long-winded way to get photos off it about 12 years ago, but it's not easy to do while out and about, so I made this!

## How it works

 1. Plug in Game Boy Camera.
 2. Turn it on.
 3. Wait a minute.
 4. Connect to the GameboyCamera wifi network.
 5. Go to http://gameboy.local
 6. All your photos will be visible on the webpage, and can be downloaded!
 7. Turn it off.

## Inside the 3D Printed Case
 - [Raspberry Pi Zero W](https://www.raspberrypi.org/products/raspberry-pi-zero-w/)
 - [InsideGadgets GBxCart RW v1.0a](https://www.gbxcart.com/)
 - [Adafruit Micro Lipo](https://www.adafruit.com/product/1904)
 - [LiPo Battery 500mAh](https://shop.pimoroni.com/products/lipo-battery-pack?variant=20429082055)
 - [USB Micro - USB Micro OTG cable](https://thepihut.com/products/micro-usb-to-micro-usb-otg-cable-10-12-25-30cm-long), shortened. (Possibly not this exact cable)
 - [Latching Torch Switch](https://www.ebay.co.uk/itm/184567179734?hash=item2af90fa9d6:g:x~IAAOSwrU1a~j8y)

## On The Pi
### Photo Downloader
 - /home/pi/get_photos.sh is set to run automatically on boot, by being included in /etc/rc.local
 - This script runs [GBxCart_RW_GBCamera_Saver_v1.8](https://github.com/insidegadgets/GBxCart-RW/tree/master/Interface_Programs)
 - And saves the photos inside /var/www/html/photos, so the web page can see them

### Web Page
 - Apache 2 web server with PHP 7
 - Files stored in /var/www/html/
 - index.php displays the photos in ./photos/, grouped by subfolder.

### Wifi Network
The Raspberry Pi hosts a wifi access point called GameboyCamera

 - Uses hostapd
 - Configured in /etc/hostapd/hostapd.conf
 - I'm not sure if just installing and creating that file is enough to make it work, I didn't make notes as I did it annoyingly.

### Issues
The Raspberry Pi doesn't keep time when it's turned off. This is annoying because GBCamera_Saver is saving the photos into folders labelled with the date/time. It still seems to work, but this may cause a problem if it's trying to create a folder with the same name again because "time is repeating itself"
