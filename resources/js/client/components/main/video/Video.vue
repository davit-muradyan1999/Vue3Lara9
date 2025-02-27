<template>
<div class="landing__video">
    <h3 class="text-heading-3 landing__video-heading">The details matter</h3>
    <div class="video"
        :class="{ play: isPlaying }"
        :style="{ backgroundImage: `url('client/videos/about-cover.webp')` }">
        <video
                ref="videoPlayer"
                class="video__player landing__video-player"
                preload="none"
                controls
                controlslist="nofullscreen nodownload"
                @play="handlePlay"
                @pause="handlePause"
            >
            <source src="/public/client/videos/about.mp4" type="video/mp4">Sorry, your browser
            doesn’ t support embedded videos.
        </video>

        <button
        v-if="!isPlaying"
        type="button"
        class="button--plain button-icon--basic video__play-button"
        @click="playVideo"
        >
        <img
            class="icon play button-icon__icon"
            src="/public/client/icons/play.svg"
            alt="play"
        />
        </button>
    </div>
</div>
</template>

<script setup>
import { ref } from 'vue';

const videoPlayer = ref(null);
const isPlaying = ref(false);

const playVideo = () => {
  videoPlayer.value.play();
};

const handlePlay = () => {
  isPlaying.value = true;
};

const handlePause = () => {
  isPlaying.value = false;
};
</script>

<style lang="scss" scoped>
@use "../../../../../assets/styles/colors.scss";
@use "../../../../../assets/styles/typography.scss";

.text-heading {
  font-family: typography.$heading;
  letter-spacing: 0.0625rem;
  line-height: 1.6em;
  font-weight: 400;
  color: colors.$charcoal100;
  margin-bottom: 2rem;
}

.text-heading-3 {
  @extend .text-heading;
  font-size: 1.5rem;
}
.video {
  width: 100%;
  padding-bottom: calc(100% * 720 / 1366);
  position: relative;
  background-size: 0;
  overflow: hidden;
  border-radius: 0.5rem;

  &::after {
    position: absolute;
    content: "";
    top: 0;
    left: 0;
    right: 0;
    bottom: 0;
    background-image: inherit;
    background-repeat: no-repeat;
    background-size: cover;
    background-position: center;
    z-index: 1;
  }
}

.video__play-button {
  position: absolute;
  z-index: 2;
  background-color: colors.$charcoal600;
  width: 4rem;
  height: 4rem;
  border-radius: 50%;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  box-shadow: 0 0 0.5rem 0px colors.$charcoal200;
  box-sizing: border-box;
  border: 0.0625rem solid colors.$charcoal400;

  path {
    fill: colors.$charcoal200;
    transition: fill 0.3s ease-in-out;
  }

  &:hover {
    transform: translate(-50%, -50%) scale(1.1);
    path {
      fill: colors.$charcoal100;
    }
  }
}

.video__player {
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  z-index: 3;
  clip-path: circle(0);
  visibility: hidden;
  opacity: 0;
  transition: visibility 0s linear 0.5s, opacity 0.5s ease-in-out, clip-path 0.5s ease-in-out;
}

.video.play {
  .video__player {
    transition: visibility 0s linear, opacity 1s ease-in-out, clip-path 1s ease-in-out;
    visibility: visible;
    clip-path: circle(100%);
    opacity: 1;
  }
}
.video__cover {
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-size: cover;
  background-position: center;
  z-index: 1;
}
</style>
